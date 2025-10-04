<?php

declare(strict_types=1);

namespace Mortezaa97\Support\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Mortezaa97\Support\Filament\Resources\Tickets\TicketResource;
use Mortezaa97\Support\Models\Ticket;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->limit ?? 15;
        Gate::authorize('viewAny', Ticket::class);
        $user = Auth::guard('api')->user();
        $tickets = Ticket::where('created_by', $user->id)->with('createdBy')->paginate($limit);

        return TicketResource::collection($tickets);
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Ticket::class);
        try {
            DB::beginTransaction();
            $item = new Ticket;
            $data = $request->only($item->fillable);

            $data['created_by'] = Auth::user()?->id;
            $files = [];
            if ($request->has('document')) {
                foreach ($request->document as $file) {
                    $files[] = Storage::disk('public')->putFile('files', $file);
                }
            }
            $data['files'] = json_encode($files);
            $ticket = $item->create($data);
            $ticket->setStatus('در انتظار بررسی');
            DB::commit();
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage(), 'data' => []], 419);
        }

        return new TicketResource($ticket);
    }

    public function show(Ticket $ticket)
    {
        Gate::authorize('view', $ticket);
        $ticket->load('children', 'createdBy');

        return new TicketResource($ticket);
    }

    public function reply(Request $request, Ticket $ticket)
    {
        Gate::authorize('reply', $ticket);
        try {
            DB::beginTransaction();
            $item = new Ticket;
            $data = $request->only('desc');
            $data['parent_id'] = $ticket->id;
            $data['created_by'] = Auth::user()->id;
            $data['status'] = 'تایید شده';

            $item = $item->create($data);

            $item->setStatus('تایید شده');
            DB::commit();
            $ticket->load('children');

            return response()->json([
                'message' => 'با موفقیت انجام شد.',
                'ticket' => new TicketResource($ticket),
            ]);
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage(), 'data' => []], 419);
        }
    }
}

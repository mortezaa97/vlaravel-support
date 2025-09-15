<?php

declare(strict_types=1);

namespace Mortezaa97\Support\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Mortezaa97\Support\Http\Resources\DepartmentResource;
use Mortezaa97\Support\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Department::class);

        return DepartmentResource::collection(Department::all());
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Department::class);
        try {
            DB::beginTransaction();
            $item = new Department;
            $data = $request->all();
            $data['created_by'] = Auth::user()->id;
            $department = $item->create($data);
            DB::commit();
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 419);
        }

        return new DepartmentResource($department);
    }

    public function show(Department $department)
    {
        Gate::authorize('view', $department);

        return new DepartmentResource($department);
    }

    public function update(Request $request, Department $department)
    {
        Gate::authorize('update', $department);
        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['updated_by'] = Auth::user()->id;
            $department->update($data);
            DB::commit();
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 419);
        }

        return new DepartmentResource($department);
    }

    public function destroy(Department $department)
    {
        Gate::authorize('delete', $department);
        try {
            DB::beginTransaction();
            DB::commit();
        } catch (Exception $exception) {
            return response()->json($exception->getMessage(), 419);
        }

        return response()->json('با موفقیت حذف شد');
    }
}

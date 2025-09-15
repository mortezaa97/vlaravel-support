<?php

declare(strict_types=1);

namespace Mortezaa97\Support\Filament\Resources\Tickets\Pages;

use Filament\Resources\Pages\CreateRecord;
use Mortezaa97\Support\Filament\Resources\Tickets\TicketResource;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;
}

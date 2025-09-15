<?php

declare(strict_types=1);

namespace Mortezaa97\Support\Filament\Resources\Tickets;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mortezaa97\Support\Filament\Resources\Tickets\Pages\CreateTicket;
use Mortezaa97\Support\Filament\Resources\Tickets\Pages\EditTicket;
use Mortezaa97\Support\Filament\Resources\Tickets\Pages\ListTickets;
use Mortezaa97\Support\Filament\Resources\Tickets\Schemas\TicketForm;
use Mortezaa97\Support\Filament\Resources\Tickets\Tables\TicketsTable;
use Mortezaa97\Support\Models\Ticket;
use UnitEnum;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static string|null|UnitEnum $navigationGroup = 'پشتیبانی';

    protected static ?string $navigationLabel = 'تیکت‌ها';

    protected static ?string $modelLabel = 'تیکت';

    protected static ?string $pluralModelLabel = 'تیکت‌ها';

    public static function form(Schema $schema): Schema
    {
        return TicketForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TicketsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTickets::route('/'),
            'create' => CreateTicket::route('/create'),
            'edit' => EditTicket::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}

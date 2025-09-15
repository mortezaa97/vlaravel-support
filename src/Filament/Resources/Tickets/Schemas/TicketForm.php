<?php

declare(strict_types=1);

namespace Mortezaa97\Support\Filament\Resources\Tickets\Schemas;

use Filament\Schemas\Schema;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            \Filament\Schemas\Components\Group::make()
                ->schema([
                    \Filament\Schemas\Components\Section::make()
                        ->schema([
                            \App\Filament\Components\Form\TitleTextInput::create()->required(),
                            \App\Filament\Components\Form\CodeTextInput::create()->required(),
                            \App\Filament\Components\Form\DescTextarea::create()->required(),
                            \Filament\Forms\Components\TextInput::make('files'),
                            \App\Filament\Components\Form\DepartmentSelect::create()->required(),
                            \App\Filament\Components\Form\CreatedBySelect::create()->required(),
                            \App\Filament\Components\Form\UpdatedBySelect::create(),
                            \Filament\Forms\Components\TextInput::make('parent_id'),

                        ])
                        ->columns(12)
                        ->columnSpan(12),
                ])
                ->columns(12)
                ->columnSpan(8),
            \Filament\Schemas\Components\Group::make()
                ->schema([
                    \Filament\Schemas\Components\Section::make()
                        ->schema([])
                        ->columns(12)
                        ->columnSpan(12),
                ])
                ->columns(12)
                ->columnSpan(4),
        ])
            ->columns(12);
    }
}

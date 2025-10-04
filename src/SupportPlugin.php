<?php

declare(strict_types=1);

namespace Mortezaa97\Support;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Mortezaa97\Support\Filament\Resources\Departments\DepartmentResource;
use Mortezaa97\Support\Filament\Resources\Tickets\TicketResource;

class SupportPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'support';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                'TicketResource' => TicketResource::class,
                'DepartmentResource' => DepartmentResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}

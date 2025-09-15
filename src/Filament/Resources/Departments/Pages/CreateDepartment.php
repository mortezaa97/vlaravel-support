<?php

declare(strict_types=1);

namespace Mortezaa97\Support\Filament\Resources\Departments\Pages;

use Filament\Resources\Pages\CreateRecord;
use Mortezaa97\Support\Filament\Resources\Departments\DepartmentResource;

class CreateDepartment extends CreateRecord
{
    protected static string $resource = DepartmentResource::class;
}

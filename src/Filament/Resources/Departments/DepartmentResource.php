<?php

declare(strict_types=1);

namespace Mortezaa97\Support\Filament\Resources\Departments;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mortezaa97\Support\Filament\Resources\Departments\Pages\CreateDepartment;
use Mortezaa97\Support\Filament\Resources\Departments\Pages\EditDepartment;
use Mortezaa97\Support\Filament\Resources\Departments\Pages\ListDepartments;
use Mortezaa97\Support\Filament\Resources\Departments\Schemas\DepartmentForm;
use Mortezaa97\Support\Filament\Resources\Departments\Tables\DepartmentsTable;
use Mortezaa97\Support\Models\Department;
use UnitEnum;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    protected static string|null|UnitEnum $navigationGroup = 'پشتیبانی';

    protected static ?string $navigationLabel = 'بخش‌ها';

    protected static ?string $modelLabel = 'بخش';

    protected static ?string $pluralModelLabel = 'بخش‌ها';

    public static function form(Schema $schema): Schema
    {
        return DepartmentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DepartmentsTable::configure($table);
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
            'index' => ListDepartments::route('/'),
            'create' => CreateDepartment::route('/create'),
            'edit' => EditDepartment::route('/{record}/edit'),
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

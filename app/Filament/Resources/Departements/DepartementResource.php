<?php

namespace App\Filament\Resources\Departements;

use App\Filament\Resources\Departements\Pages\CreateDepartement;
use App\Filament\Resources\Departements\Pages\EditDepartement;
use App\Filament\Resources\Departements\Pages\ListDepartements;
use App\Filament\Resources\Departements\Pages\ViewDepartement;
use App\Filament\Resources\Departements\Schemas\DepartementForm;
use App\Filament\Resources\Departements\Schemas\DepartementInfolist;
use App\Filament\Resources\Departements\Tables\DepartementsTable;
use App\Models\Departement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DepartementResource extends Resource
{
    protected static ?string $model = Departement::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nom';

    public static function form(Schema $schema): Schema
    {
        return DepartementForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DepartementInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DepartementsTable::configure($table);
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
            'index' => ListDepartements::route('/'),
            'create' => CreateDepartement::route('/create'),
            'view' => ViewDepartement::route('/{record}'),
            'edit' => EditDepartement::route('/{record}/edit'),
        ];
    }
}

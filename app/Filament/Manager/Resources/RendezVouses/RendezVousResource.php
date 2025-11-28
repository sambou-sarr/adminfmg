<?php

namespace App\Filament\Manager\Resources\RendezVouses;

use App\Filament\Manager\Resources\RendezVouses\Pages\CreateRendezVous;
use App\Filament\Manager\Resources\RendezVouses\Pages\EditRendezVous;
use App\Filament\Manager\Resources\RendezVouses\Pages\ListRendezVouses;
use App\Filament\Manager\Resources\RendezVouses\Pages\ViewRendezVous;
use App\Filament\Manager\Resources\RendezVouses\Schemas\RendezVousForm;
use App\Filament\Manager\Resources\RendezVouses\Schemas\RendezVousInfolist;
use App\Filament\Manager\Resources\RendezVouses\Tables\RendezVousesTable;
use App\Models\RendezVous;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RendezVousResource extends Resource
{
    protected static ?string $model = RendezVous::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'sujet';

    public static function form(Schema $schema): Schema
    {
        return RendezVousForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RendezVousInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RendezVousesTable::configure($table);
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
            'index' => ListRendezVouses::route('/'),
            'create' => CreateRendezVous::route('/create'),
            'view' => ViewRendezVous::route('/{record}'),
            'edit' => EditRendezVous::route('/{record}/edit'),
        ];
    }
}

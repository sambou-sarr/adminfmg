<?php

namespace App\Filament\Resources\Commandes;

use App\Filament\Resources\Commandes\Pages\CreateCommande;
use App\Filament\Resources\Commandes\Pages\EditCommande;
use App\Filament\Resources\Commandes\Pages\ListCommandes;
use App\Filament\Resources\Commandes\Pages\ViewCommande;
use App\Filament\Resources\Commandes\Schemas\CommandeForm;
use App\Filament\Resources\Commandes\Schemas\CommandeInfolist;
use App\Filament\Resources\Commandes\Tables\CommandesTable;
use App\Models\Commande;
use App\Models\User;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class CommandeResource extends Resource
{
    protected static ?string $model = Commande::class;

    // ✅ Utiliser la chaîne de caractères pour l’icône

    protected static ?string $recordTitleAttribute = 'numero_commande';

    /* -------------------------------------------------------------------
        FORM / TABLE / INFOLIST
    ------------------------------------------------------------------- */

    public static function form(Schema $schema): Schema
    {
        return CommandeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CommandeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CommandesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCommandes::route('/'),
            'create' => CreateCommande::route('/create'),
            'view' => ViewCommande::route('/{record}'),
            'edit' => EditCommande::route('/{record}/edit'),
        ];
    }

    /* -------------------------------------------------------------------
        AUTORISATIONS (ADMIN + SUPER_ADMIN)
    ------------------------------------------------------------------- */

    public static function canAccess(): bool
    {
        /** @var User|null $user */
        $user = Auth::user();
        return $user?->hasRole(['super_admin', 'admin']) ?? false;
    }

    public static function canViewAny(): bool
    {
        /** @var User|null $user */
        $user = Auth::user();
        return $user?->hasRole(['super_admin', 'admin']) ?? false;
    }

    public static function canCreate(): bool
    {
        /** @var User|null $user */
        $user = Auth::user();
        return $user?->hasRole(['super_admin', 'admin']) ?? false;
    }

    public static function canView(mixed $record): bool
    {
        /** @var User|null $user */
        $user = Auth::user();
        return $user?->hasRole(['super_admin', 'admin']) ?? false;
    }

    public static function canEdit(mixed $record): bool
    {
        /** @var User|null $user */
        $user = Auth::user();
        return $user?->hasRole(['super_admin', 'admin']) ?? false;
    }

    public static function canDelete(mixed $record): bool
    {
        /** @var User|null $user */
        $user = Auth::user();
        return $user?->hasRole(['super_admin', 'admin']) ?? false;
    }
}

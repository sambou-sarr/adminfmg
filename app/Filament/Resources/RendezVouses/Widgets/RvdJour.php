<?php

namespace App\Filament\Widgets;

use App\Models\RendezVous;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class RvdJour extends TableWidget
{
    // 1. Définir le nombre de colonnes à 6 (la moitié de 12)
    // Cela permet au widget d'occuper 50% de la largeur pour s'aligner sur une ligne.
    protected static function getColumns(): int | array
    {
        return 4; 
    }

    // 2. Définir l'ordre de tri à 1 pour qu'il s'aligne sur la première ligne de widgets.
    protected static ?int $sort = 1;

    protected static ?string $heading = 'Rendez-vous du jour';
    
    // Définir la limite de lignes affichées
    protected int $maxTableContentRows = 5;

    protected function getTableQuery(): Builder
    {
        return RendezVous::query()
            // Filtre uniquement les rendez-vous d'aujourd'hui
            ->whereDate('start_at', today())
            ->where('user_id', 1)
            // Ordonner par heure de début
            ->orderBy('start_at'); 
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('client_nom')
                ->label('Client')
                ->searchable(),

            TextColumn::make('start_at')
                ->label('Heure') // J'ai changé 'Date' par 'Heure' car le filtre est déjà sur le jour
                ->time('H:i') // Afficher uniquement l'heure
                ->sortable(),
                
            // Ajouter le département ou la personne responsable si disponible
            // TextColumn::make('user.name')->label('Responsable'), 
        ];
    }
}
<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Departement;

class DepartementsActifs extends StatsOverviewWidget
{
    // 1. Définir le nombre de colonnes à 6 (la moitié de 12)
    // Cela permet au widget d'occuper 50% de la largeur.
    protected  function getColumns(): int | array
    {
        return 4; 
    }

    // 2. Définir l'ordre de tri à 1 (le même que TachesEnAttente et CommandesChart)
    // Cela force le widget à s'aligner sur la première ligne de contenu.
    protected static ?int $sort = 1;

    protected ?string $heading = 'Départements';

    protected function getStats(): array
    {
        return [
            Stat::make('Départements actifs', Departement::count())
                ->description('Nombre total de départements')
                ->icon('heroicon-o-building-office')
                ->color('primary'), // J'ajoute une couleur pour la cohérence visuelle
        ];
    }
}
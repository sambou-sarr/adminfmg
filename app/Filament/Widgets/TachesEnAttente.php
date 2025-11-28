<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Tache;

class TachesEnAttente extends StatsOverviewWidget
{
    // 1. Définir le nombre de colonnes à 6 (la moitié de 12)
    protected  function getColumns(): int | array
    {
        return 6; 
    }

    // 2. Définir un ordre de tri. 
    // Mettez-le à 1 pour qu'il soit sur la première ligne, à gauche (ou à côté d'un autre widget avec le tri 1).
    protected static ?int $sort = 2;

    protected ?string $heading = 'Tâches';

    protected function getStats(): array
    {
        return [
            Stat::make('Tâches en attente', Tache::where('statut', 'à faire')->count())
                ->description('Non encore traitées')
                ->icon('heroicon-o-clock')
                ->color('warning'), // J'ai ajouté une couleur pour une meilleure visibilité
        ];
    }
}
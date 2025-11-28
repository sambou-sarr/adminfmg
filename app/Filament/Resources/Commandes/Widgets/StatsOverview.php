<?php

namespace App\Filament\Resources\Commandes\Widgets;

use App\Models\Commande;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
 protected function getStats(): array
    {
        return [
            Stat::make('Total commandes', Commande::count())
                ->description('Toutes les commandes enregistrées'),

            Stat::make('Revenus total', number_format(Commande::sum('montant_total'), 0, ',', ' ') . ' CFA')
                ->description('Somme totale encaissée'),

            Stat::make('Commandes aujourd\'hui', Commande::whereDate('created_at', today())->count())
                ->description("Commandes du " . now()->format('d/m/Y')),
        ];
    }
}

<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Commande;
use Illuminate\Support\Facades\DB; // Ensure DB is imported for complex queries

class CommandesChart extends ChartWidget
{
    // 1. Set the number of columns to 6 (half of 12)
    protected static function getColumns(): int | array
    {
        return 4;
    }

    // 2. Set the sort order to 1 so it appears on the first row 
    // next to other widgets with the same sort value.
    protected static ?int $sort = 1;

    protected ?string $heading = 'Commandes par mois';

    protected function getData(): array
    {
        // Fetch data for the current year

        $data = Commande::select(
                DB::raw('MONTH(created_at) as mois'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', date('Y')) // Filter for the current year
            ->groupBy('mois')
            ->orderBy('mois')
            ->pluck('total', 'mois')
            ->toArray();

        // Create a complete data array to ensure all months are present, even if zero
        $months = range(1, 12);
        $totals = [];

        foreach ($months as $month) {
            $totals[] = $data[$month] ?? 0;
        }

        $labels = array_map(function ($m) {
            // Translate months to French for the label
            return match($m) {
                1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril', 5 => 'Mai', 6 => 'Juin',
                7 => 'Juillet', 8 => 'Août', 9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre',
                default => 'Inconnu',
            };
        }, $months);

        return [
            'datasets' => [
                [
                    'label' => 'Commandes',
                    'data' => $totals,
                    'backgroundColor' => '#2563EB', // Filament Blue Color
                    'borderColor' => '#2563EB',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
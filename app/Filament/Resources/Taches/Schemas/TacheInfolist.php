<?php

namespace App\Filament\Resources\Taches\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\BadgeEntry;
use Filament\Schemas\Schema;

class TacheInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('assignee.name')
                    ->label('Assigné à'),

                TextEntry::make('titre')
                    ->label('Titre'),

                TextEntry::make('description')
                    ->label('Description'),

                TextEntry::make('due_date')
                    ->label('Date limite')
                    ->getStateUsing(fn ($record) => $record->due_date?->format('d/m/Y')),

                TextEntry::make('priorite')
                    ->label('Priorité')
                    ->colors([
                        'success' => 'faible',
                        'warning' => 'moyenne',
                        'danger' => 'haute',
                    ]),

                TextEntry::make('statut')
                    ->label('Statut')
                    ->colors([
                        'primary' => 'à faire',
                        'warning' => 'en cours',
                        'success' => 'terminée',
                    ]),
            ]);
    }
}

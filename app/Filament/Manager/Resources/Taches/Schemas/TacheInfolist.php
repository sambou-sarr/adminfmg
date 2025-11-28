<?php

namespace App\Filament\Manager\Resources\Taches\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TacheInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('assignee.name')
                    ->label('Assignee'),
                TextEntry::make('titre'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('due_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('priorite')
                    ->badge(),
                TextEntry::make('statut')
                    ->badge(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

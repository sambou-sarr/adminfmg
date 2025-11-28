<?php

namespace App\Filament\Manager\Resources\RendezVouses\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RendezVousInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('sujet'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('client_nom'),
                TextEntry::make('client_contact')
                    ->placeholder('-'),
                TextEntry::make('start_at')
                    ->dateTime(),
                TextEntry::make('end_at')
                    ->dateTime(),
                TextEntry::make('statut')
                    ->badge(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('rapport')
                    ->placeholder('-'),
            ]);
    }
}

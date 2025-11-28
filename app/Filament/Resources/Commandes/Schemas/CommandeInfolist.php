<?php

namespace App\Filament\Resources\Commandes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CommandeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('prenom'),
                TextEntry::make('nom'),
                TextEntry::make('telephone')
                    ->numeric(),
                TextEntry::make('adresse'),
                TextEntry::make('quantite')
                    ->numeric(),
                TextEntry::make('email')
                    ->label('Email address')
                    ->placeholder('-'),
                TextEntry::make('numero_commande'),
                TextEntry::make('montant_total')
                    ->numeric(),
                TextEntry::make('statut')
                    ->badge(),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->label('date de commande')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

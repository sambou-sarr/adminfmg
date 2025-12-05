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

                // 🔥 INFOS CLIENT


TextEntry::make('Prénoms')
    ->getStateUsing(fn ($record) => $record->client?->prenom),

TextEntry::make('Nom')
    ->getStateUsing(fn ($record) => $record->client?->nom),

TextEntry::make('Téléphone')
    ->getStateUsing(fn ($record) => $record->client?->telephone),

TextEntry::make('Email')
    ->getStateUsing(fn ($record) => $record->client?->email),

TextEntry::make('Adresse')
    ->getStateUsing(fn ($record) => $record->client?->adresse),

TextEntry::make('Type de client')
    ->getStateUsing(fn ($record) => $record->client?->type_client)
    ->badge(),

TextEntry::make('Entreprise')
    ->getStateUsing(fn ($record) => $record->client?->nom_entreprise ?? '-'),

TextEntry::make('NINEA')
    ->getStateUsing(fn ($record) => $record->client?->ninea ?? '-'),

TextEntry::make('RCCM')
    ->getStateUsing(fn ($record) => $record->client?->rccm ?? '-'),

                // 🔥 INFOS COMMANDE
                TextEntry::make('numero_commande')
                    ->label('Numéro commande'),

                TextEntry::make('montant_total')
                    ->numeric()
                    ->label('Montant total'),

                TextEntry::make('statut')
                    ->badge(),

                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),

                TextEntry::make('created_at')
                    ->label('Date de commande')
                    ->dateTime(),

                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}

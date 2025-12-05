<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ClientInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('prenom')
                    ->placeholder('-'),
                TextEntry::make('nom')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->label('Email address')
                    ->placeholder('-'),
                TextEntry::make('telephone')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('adresse')
                    ->placeholder('-'),
                TextEntry::make('type_client'),
                TextEntry::make('ninea')
                    ->placeholder('-'),
                TextEntry::make('rccm')
                    ->placeholder('-'),
                TextEntry::make('nom_entreprise')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

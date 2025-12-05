<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('prenom'),
                TextInput::make('nom'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('telephone')
                    ->tel()
                    ->numeric(),
                TextInput::make('adresse'),
                TextInput::make('type_client')
                    ->required(),
                TextInput::make('ninea'),
                TextInput::make('rccm'),
                TextInput::make('nom_entreprise'),
            ]);
    }
}

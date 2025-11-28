<?php

namespace App\Filament\Resources\Commandes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CommandeForm
{
    public static function configure(Schema $schema): Schema
    {
        $pu = 45000;
        return $schema
            ->components([
                TextInput::make('prenom')
                    ->required(),
                TextInput::make('nom')
                    ->required(),
                TextInput::make('telephone')
                    ->tel()
                    ->required()
                    ->numeric(),
                TextInput::make('adresse')
                    ->required(),
                TextInput::make('quantite')
                    ->required()
                    ->numeric(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                Select::make('statut')
                    ->options([
            'en attente' => 'En attente',
            'confirmée' => 'Confirmée',
            'en cours' => 'En cours',
            'livrée' => 'Livrée',
            'annulée' => 'Annulée',
        ])
                    ->default('en attente')
                    ->required(),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}

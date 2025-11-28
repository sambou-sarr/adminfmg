<?php

namespace App\Filament\Manager\Resources\RendezVouses\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class RendezVousForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('sujet')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('client_nom')
                    ->required(),
                TextInput::make('client_contact'),
                DateTimePicker::make('start_at')
                    ->required(),
                DateTimePicker::make('end_at')
                    ->required(),
                Select::make('statut')
                    ->options(['en_attente' => 'En attente', 'terminé' => 'Terminé', 'en_cours' => 'En cours'])
                    ->default('en_attente')
                    ->required(),
                TextInput::make('rapport'),
            ]);
    }
}

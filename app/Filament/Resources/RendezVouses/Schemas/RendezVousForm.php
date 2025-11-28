<?php

namespace App\Filament\Resources\RendezVouses\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RendezVousForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                 Section::make('Informations du rendez-vous')
                ->schema([
                    Select::make('user_id')
                        ->label('Utilisateur')
                        ->relationship('user', 'name')
                        ->required(),

                    TextInput::make('sujet')
                        ->label('Sujet')
                        ->required()
                        ->maxLength(255),

                    Textarea::make('description')
                        ->label('Description')
                        ->maxLength(1000)
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Section::make('Client')
                ->schema([
                    TextInput::make('client_nom')
                        ->label('Nom du client')
                        ->required(),

                    TextInput::make('client_contact')
                        ->label('Contact du client')
                        ->tel()
                        ->required(),
                ])
                ->columns(2),

            Section::make('Planification')
                ->schema([
                    DateTimePicker::make('start_at')
                        ->label('Date début')
                        ->required(),

                    DateTimePicker::make('end_at')
                        ->label('Date fin')
                        ->required(),
                ])
                ->columns(2),

            Section::make('Statut')
                ->schema([
                    Select::make('statut')
                        ->label('Statut')
                        ->options([
                            'en_attente' => 'En attente',
                            'en_cours'   => 'En cours',
                            'termine'    => 'Terminé',
                        ])
                        ->required()
                        ->native(false),
                ])
                ->columns(1),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Taches\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TacheForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            // Titre de la tâche
            TextInput::make('titre')
                ->label('Titre')
                ->required()
                ->maxLength(255),

            // Description
            Textarea::make('description')
                ->label('Description')
                ->required(),

            // Date limite
            DatePicker::make('due_date')
                ->label('Date limite')
                ->required(),

            // Priorité
            Select::make('priorite')
                ->label('Priorité')
                ->options([
                    'basse' => 'peu attendre',
                    'moyenne' => 'Moyenne',
                    'haute' => 'Importante',
                ])
                ->required(),

            // Statut       
            Select::make('statut')
                ->label('Statut')
                ->options([
                    'en cours' => 'en cours',
                    'terminée' => 'terminée',
                    'à faire' => 'à faire',
                ])
                ->required(),

            // Assigné à (relation avec User)
            Select::make('assignee_id')
                ->label('Assigné à')
                ->options(\App\Models\User::all()->pluck('name', 'id')->toArray())
                ->searchable()
                ->required(),
            ]);
    }
}

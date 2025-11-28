<?php

namespace App\Filament\Manager\Resources\Taches\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TacheForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('assignee_id')
                    ->relationship('assignee', 'name')
                    ->required(),
                TextInput::make('titre')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                DatePicker::make('due_date'),
                Select::make('priorite')
                    ->options(['basse' => 'Basse', 'moyenne' => 'Moyenne', 'haute' => 'Haute'])
                    ->default('moyenne')
                    ->required(),
                Select::make('statut')
                    ->options(['à faire' => 'À faire', 'en cours' => 'En cours', 'terminée' => 'Terminée'])
                    ->default('à faire')
                    ->required(),
            ]);
    }
}

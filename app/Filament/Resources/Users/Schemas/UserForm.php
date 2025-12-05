<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\Departement;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Role;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('prenom')
                    ->label('PRENOM')
                    ->required(),                
                TextInput::make('name')
                    ->label("NOM")
                    ->required(),
                TextInput::make('email')
                    ->label('ADRESSE EMAIL')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->label('MOT DE PASSE')
                    ->password()
                    ->required(),
                Select::make('role_id')  
                    ->label('Role')
                    ->options(function () {
                        return Role::all()->pluck('name', 'id')->toArray();
                    })
                    ->searchable() 
                    ->required(),
                TextInput::make('poste')
                    ->label('POSTE OCCUPEE')
                    ->required(),            
                TextInput::make('adresse')
                    ->label('Adresse')
                    ->required()
            ]);
    }
}

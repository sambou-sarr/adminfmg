<?php

namespace App\Filament\Widgets;

use App\Models\RendezVous;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class RvdJour extends TableWidget
{
    
    protected static ?int $sort = 1;

    protected static ?string $heading = 'Rendez-vous du super admin';

    protected int $maxTableContentRows = 10;

    protected function getTableQuery(): Builder
    {
        $user = Auth::user();

        // Si c’est un super_admin → il voit seulement ses rdv
            return RendezVous::query()
                ->where('user_id', $user->id)
                ->orderBy('start_at');
        
        // Sinon → aucun RDV
        return RendezVous::query()->where('id', 0);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('user.prenom')
                ->label('Prénom')
                ->sortable()
                ->searchable(),

            TextColumn::make('user.name')
                ->label('Nom')
                ->sortable()
                ->searchable(),

            TextColumn::make('sujet')
                ->label('Sujet')
                ->sortable()
                ->searchable(),

            TextColumn::make('description')
                ->label('Description')
                ->limit(40),

            TextColumn::make('client_nom')
                ->label('Client')
                ->sortable()
                ->searchable(),

            TextColumn::make('client_contact')
                ->label('Contact')
                ->sortable()
                ->searchable(),

            TextColumn::make('start_at')
                ->label('Début')
                ->datetime('Y-m-d H:i')
                ->sortable(),

            TextColumn::make('end_at')
                ->label('Fin')
                ->datetime('Y-m-d H:i')
                ->sortable(),

            TextColumn::make('statut')
                ->label('Statut')
                ->badge()
                ->color(fn ($state) => match ($state) {
                    'en_attente' => 'warning',
                    'en_cours'   => 'primary',
                    'termine'    => 'success',
                    default       => 'gray',
                }),

            TextColumn::make('created_at')
                ->label('Créé le')
                ->date('d/m/Y'),

            TextColumn::make('updated_at')
                ->label('Mis à jour')
                ->date('d/m/Y'),
        ];
    }
}

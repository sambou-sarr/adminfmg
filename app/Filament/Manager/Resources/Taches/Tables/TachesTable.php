<?php

namespace App\Filament\Manager\Resources\Taches\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class TachesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            // Modifiez la requête de base pour inclure votre filtre
            ->modifyQueryUsing(function (\Illuminate\Database\Eloquent\Builder $query) {
                // Filtre les tâches où assignee_id correspond à l'ID de l'utilisateur connecté
                $query->where('assignee_id', Auth::id());
            })
            ->columns([
                TextColumn::make('assignee.name')
                    ->searchable(),
                TextColumn::make('titre')
                    ->searchable(),
                TextColumn::make('due_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('priorite')
                    ->badge(),
                TextColumn::make('statut')
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                   Action::make('valider')
        ->label('Valider')
        ->color('success')
        ->icon('heroicon-o-check')
        ->requiresConfirmation() // Demande confirmation avant d'exécuter
        ->action(function ($record) {
            $record->update([
                'statut' => 'terminée', // Nouveau statut
            ]);
        })
            ->visible(fn ($record) => $record->statut !== 'terminée'), // Affiche le bouton seulement si pas déjà validée
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

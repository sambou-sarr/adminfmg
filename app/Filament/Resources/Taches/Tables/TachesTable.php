<?php

namespace App\Filament\Resources\Taches\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

// Note: BadgeColumn n'est plus nécessaire, on utilise TextColumn::make()->badge()

class TachesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                // Note : Utilisez 'assignee.fullName' si vous avez créé l'accessor
                TextColumn::make('assignee.prenom') 
                    ->label('Prenom')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('assignee.name') 
                    ->label('Nom')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('titre')
                    ->label('Titre')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('description')
                    ->label('Description')
                    ->limit(50) 
                    ->wrap(),

                TextColumn::make('due_date')
                    ->label('Date limite')
                    ->date('d/m/Y') // Format d/m/Y pour la France
                    ->sortable(),

                // CORRECTION DE LA PRIORITÉ : Utilisation de ->badge() et ->color()
                TextColumn::make('priorite')
                    ->label('Priorité')
                    ->badge() 
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'basse' => 'Basse',
                        'moyenne' => 'Moyenne',
                        'haute' => 'Haute',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'basse' => 'success', // Couleur verte
                        'moyenne' => 'warning', // Couleur jaune/orange
                        'haute' => 'danger', // Couleur rouge
                        default => 'gray',
                    }),

                // CORRECTION DU STATUT : Utilisation de ->badge() et ->color()
                TextColumn::make('statut')
                    ->label('Statut')
                    ->badge() // Affiche la colonne comme un badge
                    ->sortable()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'à faire' => 'À faire',
                        'en cours' => 'En cours',
                        'terminée' => 'Terminée',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'à faire' => 'info', // Bleu
                        'en cours' => 'primary', // Bleu foncé
                        'terminée' => 'success', // Vert
                        default => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Mis à jour le')
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
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ])
                ]);
    }
}

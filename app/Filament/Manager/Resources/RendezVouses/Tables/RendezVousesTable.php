<?php

namespace App\Filament\Manager\Resources\RendezVouses\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RendezVousesTable
{
    public static function configure(Table $table): Table
    {
        return $table
                    // Modifiez la requête de base pour inclure votre filtre
            ->modifyQueryUsing(function (\Illuminate\Database\Eloquent\Builder $query) {
                // Filtre les tâches où assignee_id correspond à l'ID de l'utilisateur connecté
                $query->where('user_id', Auth::id());
            })
            ->columns([
                TextColumn::make('user.name')
                    ->searchable(),
                TextColumn::make('sujet')
                    ->searchable(),
                TextColumn::make('client_nom')
                    ->searchable(),
                TextColumn::make('client_contact')
                    ->searchable(),
                TextColumn::make('start_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('end_at')
                    ->dateTime()
                    ->sortable(),
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
                TextColumn::make('rapport')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                // 1. ACTION POUR VALIDER LE RDV (Changer le Statut)
                Action::make('valider')
                    ->label('Valider le RDV')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->modalHeading('Valider le Rendez-vous')
                    ->form([
                        Select::make('nouveau_statut')
                            ->label('Statut')
                            ->options([
                                'planifié' => 'Planifié',
                                'terminé' => 'Terminé',
                                'annulé' => 'Annulé',
                                'en_cours' => 'En Cours',
                            ])
                            ->default('terminé') // Statut par défaut après validation
                            ->required(),
                    ])
                    ->action(function (Model $record, array $data) {
                        $record->statut = $data['nouveau_statut'];
                        $record->save();
                    })
                    // Afficher l'action uniquement si le statut n'est pas déjà 'terminé' ou 'annulé'
                    ->hidden(fn (Model $record): bool => in_array($record->statut, ['terminé', 'annulé'])),

                // 2. ACTION POUR SAISIR LE RAPPORT
                Action::make('saisir_rapport')
                    ->label('Saisir/Modifier Rapport')
                    ->icon('heroicon-o-clipboard-document-list')
                    ->color('info')
                    ->modalHeading(fn (Model $record) => 'Rapport pour le RDV : ' . $record->sujet)
                    ->form([
                        Textarea::make('rapport_text')
                            ->label('Contenu du Rapport')
                            ->default(fn (Model $record) => $record->rapport) // Pré-remplir si un rapport existe déjà
                            ->required()
                            ->rows(10),
                    ])
                    ->action(function (Model $record, array $data) {
                        $record->rapport = $data['rapport_text'];
                        // Optionnel : Changer le statut si le rapport est saisi
                        if ($record->statut === 'planifié' || $record->statut === 'en_cours') {
                             $record->statut = 'terminé';
                        }
                        $record->save();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

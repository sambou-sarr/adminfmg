<?php

namespace App\Filament\Resources\RendezVouses\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RendezVousesTable
{
    public static function configure(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('id')
                ->label('ID')
                ->sortable(),
            TextColumn::make('user.prenom') 
                ->label('Prenom Utilisateur')
                ->sortable()
                ->searchable(),           
            TextColumn::make('user.name') 
                ->label('Nom Utilisateur')
                ->sortable()
                ->searchable(),
            TextColumn::make('sujet')
                ->label('Sujet')
                ->sortable()
                ->searchable(),
            TextColumn::make('description')
                ->label('Description')
                ->limit(50)
                ->wrap(),
            TextColumn::make('client_nom')
                ->label('Nom du client')
                ->sortable()
                ->searchable(),
            TextColumn::make('client_contact')
                ->label('Contact du client')
                ->sortable()
                ->searchable(),
            TextColumn::make('start_at')
                ->label('Début')
                ->sortable(),
            TextColumn::make('end_at')
                ->label('Fin')
                ->sortable(),
            TextColumn::make('statut')
                ->label('Statut')
                ->getStateUsing(fn ($record) => match($record->statut) {
                    'en_attente' => 'En attente',
                    'en_cours' => 'En cours',
                    'termine' => 'Terminé',
                    default => $record->statut,
                })
                ->colors([
                    'warning' => 'en_attente',
                    'primary' => 'en_cours',
                    'success' => 'termine',
                ]),
            TextColumn::make('created_at')
                ->label('Créé le')
                ->sortable(),
            TextColumn::make('updated_at')
                ->label('Mis à jour le')
                ->sortable(),
            ])
            ->filters([])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                  // NOUVELLE ACTION : Bouton Voir Rapport
                Action::make('voir_rapport')
                    ->label('Rapport')
                    ->icon('heroicon-o-document-text')
                    // N'afficher le bouton que si le champ rapport est renseigné (Assurez-vous que 'rapport' est un champ de votre modèle RendezVous)
                    ->visible(fn ($record): bool => !empty($record->rapport)) 
                    ->modalSubmitAction(false) // Désactive le bouton d'envoi (Lecture seule)
                    ->modalCancelActionLabel('Fermer')
                    ->modalHeading(fn ($record) => 'Rapport pour: ' . $record->client_nom)
                    ->form([
                        // Affiche le champ rapport en mode lecture seule dans la modale
                        RichEditor::make('rapport')
                            ->label('Contenu du Rapport')
                            ->disabled() // Rend le champ non modifiable
                            ->default(fn ($record) => $record->rapport), // Charge le contenu
                    ])
                    ->color('gray'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

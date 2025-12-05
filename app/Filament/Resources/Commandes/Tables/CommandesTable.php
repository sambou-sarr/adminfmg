<?php

namespace App\Filament\Resources\Commandes\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Barryvdh\DomPDF\Facade\Pdf; 

class CommandesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client.prenom')
                    ->label('Prénom')
                    ->searchable(),

                TextColumn::make('client.nom')
                    ->label('Nom')
                    ->searchable(),

                TextColumn::make('client.telephone')
                    ->label('Téléphone')
                    ->sortable(),

                TextColumn::make('client.email')
                    ->label('Email')
                    ->searchable(),

                TextColumn::make('client.adresse')
                    ->label('Adresse')
                    ->searchable(),

                TextColumn::make('numero_commande')
                    ->searchable(),
                TextColumn::make('montant_total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('statut')
                    ->badge()
                    ->colors([
                        'warning' => 'en_attente',
                        'info'    => 'en cours',
                        'success' => 'livrer',
                        'danger'  => 'annuler',
                        'primary' => 'confirmer',
                    ])
                    ->icons([
                        'heroicon-o-clock'   => 'en_attente',
                        'heroicon-o-check'   => 'confirmer',
                        'heroicon-o-truck'   => 'en cours',
                        'heroicon-o-gift'    => 'livrer',
                        'heroicon-o-x-circle'=> 'annuler',
                    ]),

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
                Action::make('generate_pdf')
                    ->label('Bon de commande')
                    ->icon('heroicon-o-document-text')
                    ->color('secondary')
                    ->url(fn ($record) => route('commandes.pdf', $record->id)),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),


            ]);
    }
}

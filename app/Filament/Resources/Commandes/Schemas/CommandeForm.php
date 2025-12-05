<?php

namespace App\Filament\Resources\Commandes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Fieldset as ComponentsFieldset;
use Filament\Schemas\Schema;
use App\Models\Produit;

class CommandeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            // Choix du type de client
            Select::make('type_client')
                ->label('Type de client')
                ->options([
                    'particulier' => 'Particulier',
                    'entreprise'  => 'Entreprise',
                ])
                ->reactive()
                ->required(),

            // Fieldset Particulier
            ComponentsFieldset::make('Particulier')
                ->schema([
                    TextInput::make('prenom')->required(),
                    TextInput::make('nom')->required(),
                    TextInput::make('telephone')->required()->numeric(),
                    TextInput::make('email'),
                    TextInput::make('adresse')->required(),
                Select::make('produits')
                    ->label('Sélectionner le(s) produit(s)')
                    ->multiple()
                    ->options(Produit::all()->pluck('libelle', 'id'))
                    ->required(),

                    Select::make('choix_livraison')
                        ->options([
                            'a_domicile'       => 'À domicile',
                            'point_relais'     => 'Point relais',
                            'retrait_sur_place'=> 'Retrait sur place',
                        ])
                        ->required(),

                    Select::make('choix_paiement')
                        ->options([
                            'orange_money' => 'Orange Money',
                            'wave'         => 'Wave',
                            'especes'      => 'Espèces',
                            'carte'        => 'Carte bancaire',
                        ])
                        ->required(),

                    Select::make('statut')
                        ->options([
                            'en_attente' => 'En attente',
                            'confirmer'  => 'Confirmée',
                            'en_cours'   => 'En cours',
                            'livrer'     => 'Livrée',
                            'annuler'    => 'Annulée',
                        ])
                        ->default('en_attente')
                        ->required(),

                    Textarea::make('notes')->nullable()->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('type_client') === 'particulier'),

            ComponentsFieldset::make('Entreprise')
                ->schema([
                    TextInput::make('nom_entreprise')->required(),
                    TextInput::make('ninea')->required(),
                    TextInput::make('rccm')->required(),
                    TextInput::make('email')->email()->nullable(),

                    Select::make('choix_livraison')
                        ->options([
                            'a_domicile'       => 'À domicile',
                            'point_relais'     => 'Point relais',
                            'retrait_sur_place'=> 'Retrait sur place',
                        ])
                        ->required(),

                    Select::make('choix_paiement')
                        ->options([
                            'orange_money' => 'Orange Money',
                            'wave'         => 'Wave',
                            'especes'      => 'Espèces',
                            'carte'        => 'Carte bancaire',
                        ])
                        ->required(),
                    Select::make('produits')
                        ->label('Sélectionner le(s) produit(s)')
                        ->multiple()
                        ->options(Produit::all()->pluck('libelle', 'id'))
                        ->required(),

                    Select::make('statut')
                        ->options([
                            'en_attente' => 'En attente',
                            'confirmer'  => 'Confirmée',
                            'en_cours'   => 'En cours',
                            'livrer'     => 'Livrée',
                            'annuler'    => 'Annulée',
                        ])
                        ->default('en_attente')
                        ->required(),

                    Textarea::make('notes')->nullable()->columnSpanFull(),
                ])
                ->visible(fn ($get) => $get('type_client') === 'entreprise'),
        ]);
    }
}

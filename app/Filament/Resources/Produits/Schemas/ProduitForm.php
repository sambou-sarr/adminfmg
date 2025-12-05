<?php

namespace App\Filament\Resources\Produits\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProduitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('ref_produit')
                    ->required(),
                TextInput::make('libelle')
                    ->required(),
                TextInput::make('description')
                    ->required(),
                TextInput::make('stock')
                    ->required(),
                FileUpload::make('image')
                    ->image()
                    ->required(),
                TextInput::make('pu')
                    ->required(),
                TextInput::make('tva')
                    ->required()
                    ->numeric()
                    ->default(1.18),
            ]);
    }
}

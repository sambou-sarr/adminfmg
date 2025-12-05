<?php

namespace App\Filament\Resources\Produits\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProduitInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('ref_produit'),
                TextEntry::make('libelle'),
                TextEntry::make('description'),
                TextEntry::make('stock'),
                ImageEntry::make('image'),
                TextEntry::make('pu'),
                TextEntry::make('tva')
                    ->numeric(),
                TextEntry::make('prix_ttc')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

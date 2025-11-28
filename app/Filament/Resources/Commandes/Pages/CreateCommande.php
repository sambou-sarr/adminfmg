<?php

namespace App\Filament\Resources\Commandes\Pages;

use App\Filament\Resources\Commandes\CommandeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCommande extends CreateRecord
{
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['montant_total'] = $data['quantite'] * 45000; 
        return $data;
    }
      protected function afterCreate(): void
    {
        $this->record->numero_commande = 'FMG--' . $this->record->id . '--' . now()->format('Ymd');
        $this->record->save();
    }
    protected static string $resource = CommandeResource::class;
}

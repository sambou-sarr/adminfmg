<?php

namespace App\Filament\Resources\Commandes\Pages;

use App\Filament\Resources\Commandes\CommandeResource;
use App\Mail\CommandeCreee;
use App\Models\Client;
use App\Models\Produit;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Mail;

class CreateCommande extends CreateRecord
{
    protected static string $resource = CommandeResource::class;

    /**
     * Avant la création → créer le client + calcul total
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // 1️⃣ Calcul du montant total
        $montantTotal = 0;

        if (!empty($data['produits']) && is_array($data['produits'])) {
            foreach ($data['produits'] as $produitId) {
                $produit = Produit::find($produitId);
                if ($produit) {
                    $montantTotal += $produit->pu;
                }
            }
        }

        $data['montant_total'] = $montantTotal;

        // 2️⃣ Création ou récupération du client EXISTANT
        $client = Client::firstOrCreate(
            ['email' => $data['email'] ?? null],
            [
                'prenom'         => $data['prenom'] ?? null,
                'nom'            => $data['nom'] ?? null,
                'telephone'      => $data['telephone'] ?? null,
                'adresse'        => $data['adresse'] ?? null,
                'type_client'    => $data['type_client'] ?? 'particulier',
                'ninea'          => $data['ninea'] ?? null,
                'rccm'           => $data['rccm'] ?? null,
                'nom_entreprise' => $data['nom_entreprise'] ?? null,
            ]
        );

        // 🔥 Associer le client à la commande
        $data['id_client'] = $client->id;
        return $data;
    }

    /**
     * Après création → attacher produits + numéro commande + email
     */
    protected function afterCreate(): void
    {
        // 🔥 Relation pivot commande_produit
        if (!empty($this->form->getState()['produits'])) {
            $this->record->produits()->sync($this->form->getState()['produits']);
        }

        // 🔥 Génération du numéro unique
        $this->record->numero_commande = 'FMG-' . $this->record->id . '-' . now()->format('Ymd');
        $this->record->save();

  // 🔥 Envoi e-mail
    if (!empty($this->record->client?->email)) {
        Mail::to($this->record->client->email)->send(new CommandeCreee($this->record));
    }

    }
}

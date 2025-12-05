<?php

namespace App\Exports;

use App\Models\Commande;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CommandesExport implements FromCollection, WithHeadings
{
    /**
     * Récupération des données
     */
    public function collection()
    {
        return Commande::with('client')->get()->map(function ($commande) {
            return [
                'id'              => $commande->id,
                'token'           => $commande->token,
                'prenom'          => $commande->client?->prenom,
                'nom'             => $commande->client?->nom,
                'telephone'       => $commande->client?->telephone,
                'adresse'         => $commande->client?->adresse,
                'quantite'        => $commande->quantite,
                'choix_livraison' => $commande->choix_livraison,
                'choix_paiement'  => $commande->choix_paiement,
                'email'           => $commande->client?->email,
                'numero_commande' => $commande->numero_commande,
                'montant_total'   => $commande->montant_total,
                'type_client'     => $commande->client?->type_client,
                'ninea'           => $commande->client?->ninea,
                'nom_entreprise'  => $commande->client?->nom_entreprise,
                'rccm'            => $commande->client?->rccm,
                'statut'          => $commande->statut,
                'notes'           => $commande->notes,
                'created_at'      => $commande->created_at,
                'updated_at'      => $commande->updated_at,
            ];
        });
    }

    /**
     * Définition des en-têtes
     */
    public function headings(): array
    {
        return [
            'ID',
            'Token',
            'Prénom',
            'Nom',
            'Téléphone',
            'Adresse',
            'Quantité',
            'Choix Livraison',
            'Choix Paiement',
            'Email',
            'Numéro Commande',
            'Montant Total',
            'Type Client',
            'NINEA',
            'Nom Entreprise',
            'RCCM',
            'Statut',
            'Notes',
            'Créé le',
            'Modifié le',
        ];
    }
}

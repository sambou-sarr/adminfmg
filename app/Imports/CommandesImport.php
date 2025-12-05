<?php

namespace App\Imports;

use App\Models\Client;
use App\Models\Commande;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CommandesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Nettoyer les datas (éliminer les espaces etc.)
        $row = array_map(function ($value) {
            return is_string($value) ? trim($value) : $value;
        }, $row);
      //  dd($row);
        // ---------------------------
        // 1️⃣ CRÉATION OU RÉCUP CLIENT
        // ---------------------------

        // Si email vide → empêcher erreur dans firstOrCreate
        $email = $row['email'] ?? null;

        $client = Client::create(
            [
                'prenom'         => $row['prenom'] ?? null,
                'nom'            => $row['nom'] ?? null,
                'telephone'      => $row['telephone'] ?? null,
                'adresse'        => $row['adresse'] ?? null,
                'email' => $email,
                'type_client'    => $row['type_client'] ,
                'ninea'          => $row['ninea'] ?? null,
                'rccm'           => $row['rccm'] ?? null,
                'nom_entreprise' => $row['nom_entreprise'] ?? null,
            ]
        );

        // ---------------------------
        // 2️⃣ CRÉATION DE LA COMMANDE
        // ---------------------------

        return new Commande([
            'id_client'       => $client->id,
            'quantite'        => $row['quantite'] ?? 0,
            'choix_livraison' => $row['choix_livraison'] ?? 'a_domicile',
            'choix_paiement'  => $row['choix_paiement'] ?? 'especes',
            'numero_commande' => $row['numero_commande'] ?? Str::upper(Str::random(8)),
            'montant_total'   => $row['montant_total'] ?? 0,
            'statut'          => $row['statut'] ?? 'en_attente',
            'notes'           => $row['notes'] ?? null,
        ]);
    }
}

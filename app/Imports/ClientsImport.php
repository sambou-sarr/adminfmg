<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
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
    }
}

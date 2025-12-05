<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Client::all([
            'id',
            'prenom',
            'nom',
            'email',
            'telephone',
            'adresse',
            'type_client',
            'ninea',
            'rccm',
            'nom_entreprise',
            'created_at',
        ]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Prénom',
            'Nom',
            'Email',
            'Téléphone',
            'Adresse',
            'Type Client',
            'NINEA',
            'RCCM',
            'Nom Entreprise',
            'Date Création'
        ];
    }
}

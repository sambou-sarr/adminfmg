<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'prenom',
        'nom',
        'email',
        'telephone',
        'adresse',
        'type_client',
        'ninea',
        'rccm',
        'nom_entreprise',
    ];

    // Relation : un client a plusieurs commandes
public function commandes()
{
    return $this->hasMany(Commande::class, 'id_client');
}


    
}

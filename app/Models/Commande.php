<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
      protected $fillable = [
        'prenom',
        'nom',
        'telephone',
        'adresse',
        'quantite',
        'email',
        'montant_total',
        'statut',
        'notes',
    ];
}

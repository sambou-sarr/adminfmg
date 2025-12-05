<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Commande extends Model
{
    protected $fillable = [
        'client_id',
        'token',
        'choix_livraison',
        'choix_paiement',
        'numero_commande',
        'montant_total',
        'id_client',
        'statut',
        'notes',
    ];
        public function getLienSuiviAttribute()
{
    return url('/commande/' . $this->numero_commande);
}
protected static function booted()
{
    static::creating(function ($commande) {
        $commande->token = Str::random(64);
    });
}

    // Relation : une commande appartient à un client

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produit')
                    ->withPivot('quantite')
                    ->withTimestamps();
    }
public function client()
{
    return $this->belongsTo(Client::class, 'id_client');
}



}

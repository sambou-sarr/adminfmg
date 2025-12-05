<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'ref_produit',
        'libelle',
        'description',
        'stock',
        'image',
        'pu',
        'tva',
        'prix_ttc',
    ];

    protected $casts = [
        'pu' => 'float',
        'tva' => 'float',
        'prix_ttc' => 'float',
    ];

    // Calcul automatique du prix TTC avant la sauvegarde
    protected static function booted()
    {
        static::saving(function ($produit) {
            if ($produit->pu && $produit->tva) {
                $produit->prix_ttc = $produit->pu / $produit->tva;
            }
        });
    }
    public function commandes()
{
    return $this->belongsToMany(Commande::class, 'commande_produit')
                ->withPivot('quantite')
                ->withTimestamps();
}

}

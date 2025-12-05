<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        // Récupérer tous les produits (ou seulement ceux disponibles)
        $produits = Produit::all();

        return view('commande_client.panier', compact('produits'));
    }
}

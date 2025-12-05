<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class CommandeController extends Controller
{
    public function showByToken($token)
{
    $commande = Commande::where('token', $token)->firstOrFail();
    return view('commande_client.show', compact('commande'));
}

public function update(Request $request, $token)
{
    $commande = Commande::where('token', $token)->firstOrFail();

    $request->validate([
        'statut' => 'required|in:en_attente,confirmer,en cours,livrer,annuler',
    ]);

    $commande->statut = $request->statut;
    $commande->save();

        return redirect()->back()->with('success', 'Statut mis à jour avec succès !');
    }

    public function generatePDF($id)
    {
        $commande = Commande::findOrFail($id);

    //dd($commande);

        // Passez la variable à la vue
        $pdf = Pdf::loadView('commande_client.bon', [
            'commande' => $commande,
        ])->setPaper('A4', 'portrait');
            
        return $pdf->stream('Bon_de_commande_'.$commande->numero_commande.'.pdf');
    }

    public function afiicheform(){
        return view('commande_client.form_client');
    }
    public function ajout_commande_client(Request $request){
        dump($request);
        $commande = new Commande();
        $commande->prenom = $request->prenom;
        $commande->nom = $request->nom;
        $commande->telephone = $request->telephone;
        $commande->adresse = $request->adresse;
        $commande->choix_livraison = $request->choix_livraison;
        $commande->choix_paiement = $request->choix_paiement;
        $commande->email = $request->email;
        $commande->quantite = $request->quantite;
        $commande->montant_total = 45000 * $request->quantite;
        $commande->statut = "en_attente";
        $commande->token = Str::random(64);
        dd($commande);
        $commande->save();
    }
}

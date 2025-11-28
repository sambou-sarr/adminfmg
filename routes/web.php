<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    // Redirige l'utilisateur vers la page d'accueil (Dashboard) du panel 'admin' de Filament
    return redirect()->route('filament.admin.pages.dashboard');
});
Route::get('/create-admin', function () {
   $superAdmin = User::create([
            'prenom' => 'serge', // Champ ajouté à votre migration
            'name' => 'sylva', // Champ ajouté à votre migration
            'poste'=> 'PDG',
            'adresse'=> 'sicap',
            'email' => 'sergesilva@gmail.com', // L'email de connexion
            'password' => Hash::make('12345678'), // Mot de passe facile pour le test
            'email_verified_at' => now(),
        ]);

    return "Admin créé avec succès : " .  $superAdmin->username;
});

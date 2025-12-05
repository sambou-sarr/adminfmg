<?php

use App\Exports\ClientsExport;
use App\Exports\CommandesExport;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientExcelController;
use App\Http\Controllers\CommandeController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommandeImportController;
use Maatwebsite\Excel\Facades\Excel;
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

Route::get('/run-migrations', function () {
    // 1️⃣ Sessions
    Artisan::call('session:table');

    // 2️⃣ Départements
    Artisan::call('migrate', [
        '--path' => 'database/migrations/2025_11_20_170638_create_departements_table.php',
        '--force' => true,
    ]);

    // 3️⃣ Utilisateurs
    Artisan::call('migrate', [
        '--path' => 'database/migrations/0001_01_01_000000_create_users_table.php',
        '--force' => true,
    ]);


    // 5️⃣ Toutes les autres tables restantes
    Artisan::call('migrate', [
        '--force' => true,
    ]);

    return "Toutes les migrations ont été exécutées avec succès !";
});


Route::get('/publish-filament-assets', function () {
    Artisan::call('vendor:publish', [
        '--tag' => 'filament-assets',
        '--force' => true
    ]);

    return "Assets Filament publiés !";
});
Route::get('/clear-cache', function () {
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    Artisan::call('view:clear');
    return "Cache vidé !";
});


Route::get('/commande/suivi/{token}', [CommandeController::class, 'showByToken'])->name('commande.suivi');
Route::post('/commande/update/{token}', [CommandeController::class, 'update'])->name('commande.update');
    
Route::get('/commandes/{id}/pdf', [CommandeController::class, 'generatePDF'])->name('commandes.pdf');
Route::get('/commandes/form/client', [CommandeController::class, 'afiicheform']);
Route::post('/commandes/form/client', [CommandeController::class, 'ajout_commande_client'])->name('commande.envoi');


Route::get('/commandes/import', [CommandeImportController::class, 'formimport'])->name('form.commandes.import');
Route::post('/commandes/import', [CommandeImportController::class, 'import'])->name('commandes.import');

Route::get('/exportCommande', function () {
    return Excel::download(new CommandesExport, 'commandes.xlsx');
})->name('commandes.export');


Route::get('/clients/export', [ClientExcelController::class, 'export'])->name('clients.export');
Route::get('/clients/panier', [ClientController::class, 'index']);

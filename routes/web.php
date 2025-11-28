<?php


use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    // Redirige l'utilisateur vers la page d'accueil (Dashboard) du panel 'admin' de Filament
    return redirect()->route('filament.admin.pages.dashboard');
});


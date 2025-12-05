<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // 1. Exécute le Seeder de Rôles
        $this->call([
            RolesSeeder::class,
        ]);

        // 2. Création de l'utilisateur Super Admin
        $superAdmin = User::create([
            'prenom' => 'serge', // Champ ajouté à votre migration
            'name' => 'sylva', // Champ ajouté à votre migration
            'poste'=> 'PDG',
            'adresse'=> 'sicap',
            'email' => 'sergesilva@gmail.com', // L'email de connexion
            'password' => Hash::make('12345678'), // Mot de passe facile pour le test
            'email_verified_at' => now(),
        ])->assignRole('super_admin');

        // 3. ASSIGNER LE RÔLE
        $superAdmin->assignRole('super_admin');

        // Note : Vous pouvez créer l'Admin/Secrétaire ici aussi
        User::create([
            'prenom' => 'sambou',
            'name' => 'sarr',
            'poste'=> 'developpeur web',
            'adresse'=> 'sicap',
            'email' => 'sarrsambou03@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ])->assignRole('admin');
    }
}

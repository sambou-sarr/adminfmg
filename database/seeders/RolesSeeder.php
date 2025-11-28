<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Supprimez les rôles existants pour éviter les doublons
        Role::truncate();

        // Crée les 4 rôles
        Role::create(['name' => 'super_admin']); // Patron
        Role::create(['name' => 'admin']);       // Secretaire
        Role::create(['name' => 'responsable']); // Responsable de département
        Role::create(['name' => 'employe']);     // Employé
    }
}

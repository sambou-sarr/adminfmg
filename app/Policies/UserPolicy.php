<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Optionnel : Permettre au Super Admin de bypasser toutes les vérifications.
     * C'est la ligne la plus importante pour vous en tant qu'administrateur.
     */
    public function before(User $user, string $ability): ?bool
    {
        // CORRECTION : Utiliser le nom exact du rôle de la base de données : 'super_admin'
        if ($user->hasRole('super_admin')) {
            return true;
        }

        return null; 
    }

    /**
     * Determine whether the user can view any models (voir la liste des utilisateurs).
     * Si cette méthode retourne false, le Resource est masqué dans la navigation.
     */
    public function viewAny(User $user): bool
    {
        // CORRECTION : Utiliser le nom exact du rôle de la base de données : 'super_admin'
        return $user->hasRole('super_admin');
    }

    /**
     * Determine whether the user can create models.
     * La méthode 'create' contrôle l'action "New User" dans Filament.
     */
    public function create(User $user): bool
    {
        // CORRECTION : Utiliser le nom exact du rôle de la base de données : 'super_admin'
        return $user->hasRole('super_admin');
    }

    // Laissez les autres méthodes (view, update, delete) selon vos besoins
    // ...
}
<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Commande;

class CommandePolicy
{
    public function viewAny(User $user)
    {
        return $user->hasRole(['super_admin', 'admin']);
    }

    public function view(User $user, Commande $commande)
    {
        return $user->hasRole(['super_admin', 'admin']);
    }

    public function create(User $user)
    {
        return $user->hasRole(['super_admin', 'admin']);
    }

    public function update(User $user, Commande $commande)
    {
        return $user->hasRole(['super_admin', 'admin']);
    }

    public function delete(User $user, Commande $commande)
    {
        return $user->hasRole(['super_admin', 'admin']);
    }
}

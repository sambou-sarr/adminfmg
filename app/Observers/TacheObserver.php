<?php

namespace App\Observers;

use App\Mail\NewTaskNotification;
use App\Models\Tache;
use Illuminate\Support\Facades\Mail;

class TacheObserver
{
    /**
     * Handle the Tache "created" event.
     */
    public function created(Tache $tache): void
    {
        // Envoyez l'email à la personne concernée (par exemple l'employé assigné)
        Mail::to($tache->assignee->email)
            // Utilisez la file d'attente (queue) pour ne pas bloquer l'interface Filament
            ->queue(new NewTaskNotification($tache));
    }

    /**
     * Handle the Tache "updated" event.
     */
    public function updated(Tache $tache): void
    {
        //
    }

    /**
     * Handle the Tache "deleted" event.
     */
    public function deleted(Tache $tache): void
    {
        //
    }

    /**
     * Handle the Tache "restored" event.
     */
    public function restored(Tache $tache): void
    {
        //
    }

    /**
     * Handle the Tache "force deleted" event.
     */
    public function forceDeleted(Tache $tache): void
    {
        //
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\RendezVous;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\RappelRdvMail;

class RappelRdvCommand extends Command
{
    protected $signature = 'rappel:rdv';
    protected $description = 'Envoyer un rappel automatique des rendez-vous qui approchent';

    public function handle()
    {
        $rdvs = RendezVous::with('user')
            ->whereDate('start_at', Carbon::tomorrow()) // Rappel 24h avant
            ->get();

        foreach ($rdvs as $rdv) {
            if ($rdv->user && $rdv->user->email) {
                Mail::to($rdv->user->email)->send(new RappelRdvMail($rdv));
            }
        }

        $this->info('Rappels envoyés avec succès.');
    }
}

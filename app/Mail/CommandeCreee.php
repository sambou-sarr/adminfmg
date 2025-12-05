<?php

namespace App\Mail;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommandeCreee extends Mailable
{
    use Queueable, SerializesModels;

    public Commande $commande;

    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

public function build()
{
    return $this->subject('Votre commande FMG')
                ->view('email.commande-creee')
                ->with([
                    'commande' => $this->commande,
                    'lien_suivi' => route('commande.suivi', $this->commande->token),
                ]);
}

}

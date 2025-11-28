<?php

namespace App\Filament\Resources\RendezVouses\Pages;
use Illuminate\Support\Facades\Mail;

use App\Filament\Resources\RendezVouses\RendezVousResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRendezVous extends CreateRecord
{
    protected static string $resource = RendezVousResource::class;
    protected function afterCreate(): void
{
    $rdv = $this->record;

    // Notification Filament
    \Filament\Notifications\Notification::make()
        ->title('Nouveau rendez-vous')
        ->body("Le rendez-vous « {$rdv->titre} » a été créé.")
        ->success()
        ->sendToDatabase($rdv->user); // notification envoyée à la personne concernée

    // Email automatique
    if ($rdv->user && $rdv->user->email) {
        Mail::to($rdv->user->email)
            ->send(new \App\Mail\RappelRdvMail($rdv));
    }
}

}

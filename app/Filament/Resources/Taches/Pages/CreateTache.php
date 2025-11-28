<?php

namespace App\Filament\Resources\Taches\Pages;

use App\Filament\Resources\Taches\TacheResource;
use App\Mail\NewTaskAssignedMail;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Mail;

class CreateTache extends CreateRecord
{
    
    protected static string $resource = TacheResource::class;

    protected function afterCreate(): void
    {
        $tache = $this->record;
        if ($tache->assignee && $tache->assignee->email) {
            Mail::to($tache->assignee->email)
                ->send(new NewTaskAssignedMail($tache));
        }
    }
}

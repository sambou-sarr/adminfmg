<?php

namespace App\Filament\Manager\Resources\RendezVouses\Pages;

use App\Filament\Manager\Resources\RendezVouses\RendezVousResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRendezVous extends ViewRecord
{
    protected static string $resource = RendezVousResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

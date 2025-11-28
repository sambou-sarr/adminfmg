<?php

namespace App\Filament\Resources\RendezVouses\Pages;

use App\Filament\Resources\RendezVouses\RendezVousResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRendezVouses extends ListRecords
{
    protected static string $resource = RendezVousResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

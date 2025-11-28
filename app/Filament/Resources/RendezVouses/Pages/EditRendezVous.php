<?php

namespace App\Filament\Resources\RendezVouses\Pages;

use App\Filament\Resources\RendezVouses\RendezVousResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRendezVous extends EditRecord
{
    protected static string $resource = RendezVousResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

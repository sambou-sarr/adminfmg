<?php

namespace App\Filament\Resources\Departements\Pages;

use App\Filament\Resources\Departements\DepartementResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDepartement extends ViewRecord
{
    protected static string $resource = DepartementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

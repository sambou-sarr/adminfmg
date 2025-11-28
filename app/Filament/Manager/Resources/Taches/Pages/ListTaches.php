<?php

namespace App\Filament\Manager\Resources\Taches\Pages;

use App\Filament\Manager\Resources\Taches\TacheResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTaches extends ListRecords
{
    protected static string $resource = TacheResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\Clients\Pages;

use App\Filament\Resources\Clients\ClientResource;
use App\Imports\ClientsImport;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListClients extends ListRecords
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            // Exporter Excel
            Action::make('exporter_excel')
                ->label('Exporter Excel')
                ->button()
                ->color('success')
                ->url(route('clients.export'))
                ->openUrlInNewTab(),
        ];
    }
}

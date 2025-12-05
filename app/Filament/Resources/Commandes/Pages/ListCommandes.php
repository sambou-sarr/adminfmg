<?php

namespace App\Filament\Resources\Commandes\Pages;

use App\Filament\Resources\Commandes\CommandeResource;
use App\Filament\Resources\Commandes\Widgets\StatsOverview;
use App\Imports\CommandesImport;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;

class ListCommandes extends ListRecords
{
    protected static string $resource = CommandeResource::class;

    // ✅ Boutons dans le header (New Commande + Importer Excel)
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(), // bouton "New Commande"

            Action::make('importer_excel')
                ->label('Importer Excel')
                ->button()
                ->color('success')
                ->modalHeading('Importer un fichier Excel')
                ->modalButton('Importer')
                ->form([
                    FileUpload::make('file')
                        ->label('Fichier Excel')
                        ->acceptedFileTypes([
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'application/vnd.ms-excel',
                        ])
                        ->required(),
                ])
                ->action(function (array $data) {
                    Excel::import(new CommandesImport, $data['file']);

                    \Filament\Notifications\Notification::make()
                        ->title('Fichier importé avec succès !')
                        ->success()
                        ->send();
                }),
        Action::make('exporter_excel')
            ->label('Exporter Excel')
            ->button()
            ->color('success')
            ->url(route('commandes.export'))
            ->openUrlInNewTab(),
        ];
    }

    // ✅ Widgets en haut de la page
    public function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
        ];
    }
}

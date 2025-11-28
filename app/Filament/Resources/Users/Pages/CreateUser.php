<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    // Déclaration de la propriété pour stocker le rôle sélectionné
    protected $role;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Récupère l'ID du rôle sélectionné
        $this->role = $data['role_id'];
        unset($data['role_id']); // Ce champ n'existe pas dans la table users

        return $data;
    }

    protected function afterCreate(): void
    {
        // Assigne le rôle correspondant à l'utilisateur créé
        $this->record->assignRole($this->role);
    }

    protected static string $resource = UserResource::class;
}

<?php

namespace App\Filament\Resources\MedicationBagResource\Pages;

use App\Filament\Resources\MedicationBagResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMedicationBag extends CreateRecord
{
    protected static string $resource = MedicationBagResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

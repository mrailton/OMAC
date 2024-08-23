<?php

declare(strict_types=1);

namespace App\Filament\Resources\MedicationResource\Pages;

use App\Filament\Resources\MedicationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMedication extends CreateRecord
{
    protected static string $resource = MedicationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

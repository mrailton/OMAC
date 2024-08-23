<?php

namespace App\Filament\Resources\MedicationBagResource\Pages;

use App\Filament\Resources\MedicationBagResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMedicationBag extends ViewRecord
{
    protected static string $resource = MedicationBagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

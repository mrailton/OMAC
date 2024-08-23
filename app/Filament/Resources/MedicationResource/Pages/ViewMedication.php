<?php

declare(strict_types=1);

namespace App\Filament\Resources\MedicationResource\Pages;

use App\Filament\Resources\MedicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMedication extends ViewRecord
{
    protected static string $resource = MedicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

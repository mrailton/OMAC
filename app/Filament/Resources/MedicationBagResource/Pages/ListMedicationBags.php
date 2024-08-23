<?php

declare(strict_types=1);

namespace App\Filament\Resources\MedicationBagResource\Pages;

use App\Filament\Resources\MedicationBagResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMedicationBags extends ListRecords
{
    protected static string $resource = MedicationBagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

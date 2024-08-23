<?php

declare(strict_types=1);

namespace App\Filament\Resources\MedicationBagStockResource\Pages;

use App\Filament\Resources\MedicationBagStockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMedicationBagStocks extends ListRecords
{
    protected static string $resource = MedicationBagStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

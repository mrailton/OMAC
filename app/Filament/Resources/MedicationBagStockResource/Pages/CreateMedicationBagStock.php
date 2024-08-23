<?php

declare(strict_types=1);

namespace App\Filament\Resources\MedicationBagStockResource\Pages;

use App\Filament\Resources\MedicationBagStockResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMedicationBagStock extends CreateRecord
{
    protected static string $resource = MedicationBagStockResource::class;
}

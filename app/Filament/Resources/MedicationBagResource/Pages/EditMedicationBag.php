<?php

declare(strict_types=1);

namespace App\Filament\Resources\MedicationBagResource\Pages;

use App\Filament\Resources\MedicationBagResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMedicationBag extends EditRecord
{
    protected static string $resource = MedicationBagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

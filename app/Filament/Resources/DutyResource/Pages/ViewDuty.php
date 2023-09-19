<?php

declare(strict_types=1);

namespace App\Filament\Resources\DutyResource\Pages;

use App\Filament\Resources\DutyResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDuty extends ViewRecord
{
    protected static string $resource = DutyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Filament\Resources\DutyResource\Pages;

use App\Filament\Resources\DutyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDuty extends EditRecord
{
    protected static string $resource = DutyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

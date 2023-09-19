<?php

declare(strict_types=1);

namespace App\Filament\Resources\DutyResource\Pages;

use App\Filament\Resources\DutyResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDuty extends CreateRecord
{
    protected static string $resource = DutyResource::class;
}

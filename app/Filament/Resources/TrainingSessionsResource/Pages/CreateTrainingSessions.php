<?php

declare(strict_types=1);

namespace App\Filament\Resources\TrainingSessionsResource\Pages;

use App\Filament\Resources\TrainingSessionsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTrainingSessions extends CreateRecord
{
    protected static string $resource = TrainingSessionsResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

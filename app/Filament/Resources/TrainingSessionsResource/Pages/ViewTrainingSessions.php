<?php

namespace App\Filament\Resources\TrainingSessionsResource\Pages;

use App\Filament\Resources\TrainingSessionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTrainingSessions extends ViewRecord
{
    protected static string $resource = TrainingSessionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

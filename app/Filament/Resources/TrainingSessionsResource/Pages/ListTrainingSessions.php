<?php

declare(strict_types=1);

namespace App\Filament\Resources\TrainingSessionsResource\Pages;

use App\Exports\TrainingExport;
use App\Filament\Resources\TrainingSessionsResource;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;

class ListTrainingSessions extends ListRecords
{
    protected static string $resource = TrainingSessionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            ExportAction::make()
                ->label('Export Training Sessions')
                ->form([
                    DatePicker::make('export_from')->default(now()->subYear()),
                    DatePicker::make('export_to')->default(now()),
                ])
                ->action(function (array $data) {
                    $from = $data['export_from'] ?? null;
                    $to = $data['export_to'] ?? null;

                    return Excel::download(new TrainingExport($from, $to), 'Rathdrum OMAC Training Sessions Export ' . $from . ' - ' . $to . '.xlsx');
                }),
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Filament\Resources\DutyResource\Pages;

use App\Exports\DutyExport;
use App\Filament\Resources\DutyResource;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;

class ListDuties extends ListRecords
{
    protected static string $resource = DutyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            ExportAction::make()
                ->label('Export Duties')
                ->form([
                    DatePicker::make('export_from')->default(now()->subYear()),
                    DatePicker::make('export_to')->default(now()),
                ])
                ->action(function (array $data) {
                    $from = $data['export_from'] ?? null;
                    $to = $data['export_to'] ?? null;

                    return Excel::download(new DutyExport($from, $to), 'Rathdrum OMAC Duties Export ' . $from . ' - ' . $to . '.xlsx');
                }),
        ];
    }
}

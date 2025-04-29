<?php

declare(strict_types=1);

namespace App\Filament\Resources\MemberResource\Pages;

use App\Exports\MemberExport;
use App\Filament\Resources\MemberResource;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;

class ListMembers extends ListRecords
{
    protected static string $resource = MemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            ExportAction::make()
                ->label('Export Member List')
                ->form([
                    DatePicker::make('export_from')->label('From')->default(now()->subYear()),
                    DatePicker::make('export_to')->label('To')->default(now()),
                ])
                ->action(function (array $data) {
                    $from = $data['export_from'] ?? null;
                    $to = $data['export_to'] ?? null;

                    return Excel::download(new MemberExport($from, $to), 'Rathdrum OMAC Members Export ' . $from . ' - ' . $to . '.xlsx');
                }),
        ];
    }
}

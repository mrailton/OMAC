<?php

declare(strict_types=1);

namespace App\Exports;

use App\Models\Duty;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DutyExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    public function __construct(protected $from = null, protected $to = null)
    {
    }

    public function collection(): Collection
    {
        return Duty::query()
            ->whereBetween('start', [$this->from, $this->to])
            ->with(['members', 'vehicles'])
            ->get();
    }

    public function headings(): array
    {
        return [
            'Date', 'Name', 'Organizer', 'Members', 'Vehicles', 'Notes',
        ];
    }

    public function map($row): array
    {
        return [
            $row->start->format('d/m/Y'),
            $row->name,
            $row->organizer,
            $row->members->pluck('name')->sort()->implode(', '),
            $row->vehicles->pluck('call_sign')->sort()->implode(', '),
            $row->notes,
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Exports;

use App\Models\TrainingSession;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TrainingExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    public function __construct(protected $from = null, protected $to = null)
    {
    }

    public function collection(): Collection
    {
        return TrainingSession::query()
            ->whereBetween('date', [$this->from, $this->to])
            ->with('members')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Date', 'Topic', 'Attendees', 'Notes',
        ];
    }

    public function map($row): array
    {
        return [
            $row->date->format('d/m/Y'),
            $row->topic,
            $row->members->pluck('name')->sort()->implode(', '),
            $row->notes,
        ];
    }
}

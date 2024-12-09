<?php

namespace App\Exports;

use App\Models\Member;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MemberExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    public function __construct(protected $from = null, protected $to = null) {}

    public function collection(): Collection
    {
        $query = Member::query();

        $members = $query
            ->whereNull('deleted_at')
            ->get();

        $trashedMembers = Member::onlyTrashed()
            ->whereHas('trainingSessions', function ($query) {
                $query->whereBetween('date', [$this->from, $this->to]);
            })
            ->orWhereHas('duties', function ($query) {
                $query->whereBetween('start', [$this->from, $this->to]);
            })
            ->get();

        $members = $members->merge($trashedMembers)->sortBy('name');

        $members->each(function ($member) {
            $member->trainings_attended = $member->trainingSessions()
                ->whereBetween('date', [$this->from, $this->to])
                ->count();

            $member->duties_attended = $member->duties()
                ->whereBetween('start', [$this->from, $this->to])
                ->count();

            $member->duty_hours = $member->duties()
                ->whereBetween('start', [$this->from, $this->to])
                ->get()
                ->sum(fn ($duty) => $duty->start->diffInMinutes($duty->end) / 60);
        });

        return $members;
    }

    public function headings(): array
    {
        return [
            'Name', 'Active', 'Driver', 'Trainings Attended', 'Duties Attended', 'Duty Hours', 'OMAC ID', 'Email', 'Phone', 'Rank',
            'Clinical Level', 'Cert Number', 'Cert Expires On', 'CFR Level', 'CFR Cert Number', 'CFR Expires On', 'Garda Vetting ID',
            'Garda Vetting Date', 'CPAP Date',
        ];
    }

    public function map($member): array
    {
        return [
            $member->name,
            $member->active ? 'Yes' : 'No',
            $member->driver ? 'Yes' : 'No',
            $member->trainings_attended,
            $member->duties_attended,
            round($member->duty_hours, 2),
            $member->omac_id_number,
            $member->email,
            $member->phone,
            $member->rank->value,
            $member->clinical_level->value,
            $member->cert_number,
            $member->cert_expires_on,
            $member->cfr_level->value,
            $member->cfr_cert_number,
            $member->cfr_expires_on,
            $member->garda_vetting_id,
            $member->garda_vetting_date,
            $member->cpap_date,
        ];
    }
}

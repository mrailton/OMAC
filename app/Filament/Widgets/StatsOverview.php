<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Duty;
use App\Models\Member;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    use HasWidgetShield;

    protected function getStats(): array
    {
        $totalDutyMinutes = 0;

        $duties = Duty::query()
            ->with('members')
            ->whereYear('start', '=', now())
            ->where('end', '<=', now())
            ->get();

        foreach ($duties as $duty) {
            $memberCount = $duty->members()->withTrashed()->count();

            if ($memberCount > 0) {
                $dutyMinutes = (int)$duty->start->diffInMinutes($duty->end) * $memberCount;

                $totalDutyMinutes += $dutyMinutes;
            }
        }

        $hours = floor($totalDutyMinutes / 60);
        $minutes = $totalDutyMinutes % 60;

        if (mb_strlen((string)$hours) < 2) {
            $hours = '0' . $hours;
        }

        if (mb_strlen((string)$minutes) < 2) {
            $minutes = '0' . $minutes;
        }

        return [
            Stat::make('Total Members', Member::query()->count()),
            Stat::make('Active Members', Member::query()->where('active', '=', true)->count()),
            Stat::make('Duties This Year', $duties->count()),
            Stat::make('Duty Time This Year (hours:minutes)', $hours . ':' . $minutes),
        ];
    }
}

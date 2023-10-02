<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Duty;
use App\Models\Member;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $dutyHours = 0;
        $duties = Duty::query()
            ->with('members')
            ->whereYear('start', '=', now())
            ->where('end', '<=', now())
            ->get();

        foreach ($duties as $duty) {
            $memberCount = $duty->members()->withTrashed()->count();

            if ($memberCount > 0) {
                $duration = $duty->end->diffInMinutes($duty->start);

                $dutyHours += ($duration * $memberCount) / 60;
            }
        }

        return [
            Stat::make('Total Members', Member::query()->count()),
            Stat::make('Active Members', Member::query()->where('active', '=', true)->count()),
            Stat::make('Duties This Year', $duties->count()),
            Stat::make('Duty Hours This Year', (int) round($dutyHours)),
        ];
    }
}

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
        $duties = Duty::query()->with('members')->whereYear('start', '=', now()->format('Y'))->get();

        foreach ($duties as $duty) {
            if ($duty->members()->count() > 0) {
                $duration = $duty->end->diffInHours($duty->start);

                $dutyHours += ($duration * $duty->members()->count());
            }
        }

        return [
            Stat::make('Total Members', Member::query()->count()),
            Stat::make('Active Members', Member::query()->where('active', '=', true)->count()),
            Stat::make('Duties This Year', $duties->count()),
            Stat::make('Duty Hours This Year', $dutyHours),
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Duty;
use App\Models\Member;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Carbon\CarbonInterval;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    use HasWidgetShield;

    protected function getStats(): array
    {
        $dutyHours = new CarbonInterval();

        $duties = Duty::query()
            ->with('members')
            ->whereYear('start', '=', now())
            ->where('end', '<=', now())
            ->get();

        foreach ($duties as $duty) {
            $memberCount = $duty->members()->withTrashed()->count();

            if ($memberCount > 0) {
                $dutyHours->add($duty->start->diff($duty->end)->multiply($memberCount));
            }
        }

        return [
            Stat::make('Total Members', Member::query()->count()),
            Stat::make('Active Members', Member::query()->where('active', '=', true)->count()),
            Stat::make('Duties This Year', $duties->count()),
            Stat::make('Duty Time This Year (hours:minutes)', $dutyHours->hours . ':' . $dutyHours->minutes),
        ];
    }
}

<?php

namespace App\Filament\Widgets;

use App\Models\Duty;
use App\Models\Member;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Members', Member::count()),
            Stat::make('Duties This Year', Duty::query()->whereYear('start', '=', now()->format('Y'))->count())
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Console;

use App\Console\Commands\CertificateExpiryReport;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Spatie\Health\Commands\RunHealthChecksCommand;
use Spatie\Health\Commands\ScheduleCheckHeartbeatCommand;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('backup:clean')->dailyAt('03:15');
        $schedule->command('backup:run')->dailyAt('03:30');
        $schedule->command(RunHealthChecksCommand::class)->everyMinute();
        $schedule->command(ScheduleCheckHeartbeatCommand::class)->everyMinute();
        $schedule->command(CertificateExpiryReport::class)->monthlyOn(1, '09:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}

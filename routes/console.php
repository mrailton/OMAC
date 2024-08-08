<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schedule;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Schedule::command('health:check')->everyMinute();
Schedule::command('backup:clean')->dailyAt('04:15');
Schedule::command('backup:run')->dailyAt('04:30');
Schedule::command('report:certificate-expiry')->monthlyOn(1, '12:00');
Schedule::command('health:schedule-check-heartbeat')->everyMinute();

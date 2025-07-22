<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
Schedule::command('app:notificationinstructiondelais')->everyTwoMinutes();
Schedule::command('app:notificationrecourspresidents')->monthly();

//Schedule::command('app:notificationinstructiondelais')->dailyAt('06:00');

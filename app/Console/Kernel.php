<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
  protected $commands = [
     \App\Console\Commands\AutoPayment::class,
     \App\Console\Commands\SendAutoRenewReminder::class,
  ];
  protected function schedule(Schedule $schedule)
    {
        $schedule->command('send:auto-renew-reminder')->everyMinute();
        $schedule->command('app:auto-payment')->everyMinute();
    }

}
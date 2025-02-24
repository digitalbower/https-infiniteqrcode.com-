<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
  
  protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        $users = User::whereDate('trial_ends_at', now()->addDay())->get();
        
        foreach ($users as $user) {
            (new App\Http\Controllers\TrialController)->sendTrialEndEmail($user);
        }
    })->daily();
}
   

}
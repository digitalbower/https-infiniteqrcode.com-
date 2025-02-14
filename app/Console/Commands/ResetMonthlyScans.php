<?php

namespace App\Console\Commands;

use App\Models\QrBasicInfo;
use Illuminate\Console\Command;

class ResetMonthlyScans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-monthly-scans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset total_scans for paid users at the start of each month';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Reset total_scans for users with paid plans
        QrBasicInfo::whereHas('user', function ($query) {
            $query->whereIn('plan', ['basic', 'pro', 'expert']);
        })
        ->update(['total_scans' => 0]);        

        $this->info('Monthly scan counts have been reset.');
    }
}

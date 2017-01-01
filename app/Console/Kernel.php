<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\GetDonations::class,
        \App\Console\Commands\GetTweets::class,
        \App\Console\Commands\MakeSpreadsheet::class,
        \App\Console\Commands\SetNewDayTotal::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        if (in_array(date('m'), ['1', '12'])) {
            $filePath = storage_path('logs/cronlog');

            $schedule->command('jj:donations')->everyMinute()->sendOutputTo($filePath .'_donations');
            $schedule->command('jj:tweets')->everyFiveMinutes()->sendOutputTo($filePath .'_tweets');
            $schedule->command('jj:new-day-total')->hourly()->sendOutputTo($filePath .'_new_day');
        }
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // $this->command('build {project}', function ($project) {
        //     $this->info('Building project...');
        // });
    }
}

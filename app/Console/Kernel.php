<?php

namespace App\Console;

use App\Console\Commands\Install;
use App\Models\Doc;
use App\Models\Tag;
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
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->call(function () {
//           Tag::getTagList();
//            updateTags();
//            updateBrands();
//        })->hourly();
//
        $schedule->call(function () {
            Doc::fetchNews();
            Doc::query()->each(function (Doc $doc) {
                $doc->fetchContent();
            });
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

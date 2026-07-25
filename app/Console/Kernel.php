<?php

namespace App\Console;

use App\Mail\SampleMail;
use App\Models\UserSupport;
use App\Services\Notification\SmsSender;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel {
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            //Log::info("Test Schedule Task");
            //Mail::to("hosseindeveloper2022@gmail.com")->send(new SampleMail());
            //Log::info("Log after Send Email");
            $support_list = UserSupport::with('admin', 'user')
                ->where('support_time', '>', Carbon::now()->toDateTimeString())
                ->where('support_time', '<', now()->addMonth())
                ->where('done_time', null)
                ->orderBy('support_time')
                ->get();
            foreach ($support_list as $item) {
                //Log::info("Support Time:#" . $item->user->id . ' ' . $item->user->full_name . '->' . $item->support_time);
                SmsSender::support_registered($item);
            }


        })->everyMinute();

        // آلارم داخل‌برنامه‌ای (نوتیفیکیشن) وقتی تاریخ پشتیبانی یک مشتری فرا می‌رسد
        $schedule->command('user-supports:check-alarms')->dailyAt('08:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands() {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }


}

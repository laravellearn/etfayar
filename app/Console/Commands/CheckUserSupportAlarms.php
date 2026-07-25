<?php

namespace App\Console\Commands;

use App\Models\UserSupport;
use App\Services\Notification\SystemNotifier;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class CheckUserSupportAlarms extends Command {
    /**
     * دستور: php artisan user-supports:check-alarms
     *
     * برای هر پشتیبانی مشتری که:
     *  - هنوز انجام نشده (status = 0)
     *  - تاریخ پشتیبانی‌اش (support_time) رسیده یا گذشته
     *  - قبلاً آلارمش ارسال نشده (alarm_sent_at خالیه)
     * یک نوتیفیکیشن برای همون ادمینی که مسئول این پشتیبانیه (admin_id) می‌فرسته،
     * و alarm_sent_at رو پر می‌کنه تا دوباره ارسال نشه.
     *
     * این دستور باید به‌صورت روزانه (در app/Console/Kernel.php) زمان‌بندی بشه.
     *
     * @var string
     */
    protected $signature = 'user-supports:check-alarms';

    protected $description = 'ارسال آلارم برای پشتیبانی‌های مشتریانی که تاریخشان رسیده و هنوز انجام نشده';

    public function handle() {
        $due = UserSupport::with('user')
            ->where('status', 0)
            ->whereNull('alarm_sent_at')
            ->whereNotNull('support_time')
            ->where('support_time', '<=', Carbon::now())
            ->get();

        $count = 0;
        foreach ($due as $support) {
            $customerName = $support->user->full_name ?? '';
            SystemNotifier::toAdmin(
                $support->admin_id,
                'یادآوری پشتیبانی مشتری',
                "زمان پشتیبانیِ مشتری {$customerName} فرا رسیده است.",
                route('user_support.edit', $support->id)
            );
            $support->alarm_sent_at = Carbon::now();
            $support->save();
            $count++;
        }

        $this->info("{$count} آلارم پشتیبانی ارسال شد.");

        return self::SUCCESS;
    }
}

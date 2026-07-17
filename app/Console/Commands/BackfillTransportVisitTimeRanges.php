<?php

namespace App\Console\Commands;

use App\Models\Transport;
use Illuminate\Console\Command;

class BackfillTransportVisitTimeRanges extends Command {
    /**
     * دستور: php artisan transports:backfill-visit-time
     *
     * برای رکوردهای قدیمی transports که فقط فیلد تکی visit_time را داشتند،
     * آن مقدار را به عنوان ابتدای بازه‌ی اول (visit_time_from_1) کپی می‌کند.
     *
     * توجه مهم: visit_time قدیم فقط یک ساعت تکی بوده (نه یک بازه)، پس
     * "تا ساعتِ" بازه‌ی اول (visit_time_to_1) و کل بازه‌ی دوم را نمی‌توان
     * از روی داده‌ی قدیمی حدس زد — این مقادیر خالی باقی می‌مانند.
     * این یعنی برای رکوردهای قدیمی همچنان فقط یک ساعت نمایش داده می‌شود،
     * نه یک بازه‌ی کامل - چون داده‌ی دقیق‌تری برای آن‌ها هرگز ثبت نشده بود.
     *
     * @var string
     */
    protected $signature = 'transports:backfill-visit-time {--dry-run : فقط نمایش تعداد رکوردهای تحت تاثیر، بدون ذخیره}';

    protected $description = 'کپیِ ساعت مراجعه‌ی قدیمی (visit_time) به فیلد جدید visit_time_from_1 برای رکوردهای قدیمی';

    public function handle() {
        $dryRun = (bool) $this->option('dry-run');
        $updated = 0;

        Transport::withTrashed()
            ->whereNotNull('visit_time')
            ->whereNull('visit_time_from_1')
            ->chunkById(200, function ($transports) use (&$updated, $dryRun) {
                foreach ($transports as $transport) {
                    $transport->visit_time_from_1 = $transport->visit_time;
                    $updated++;
                    if (!$dryRun) {
                        $transport->save();
                    }
                }
            });

        $prefix = $dryRun ? '[dry-run] ' : '';
        $this->info("{$prefix}ساعت مراجعه‌ی {$updated} رکورد به visit_time_from_1 کپی شد.");
        $this->warn('توجه: بازه‌ی دوم و انتهای بازه‌ی اول برای این رکوردها خالی می‌ماند، چون داده‌ی قدیمی فقط یک ساعت تکی بوده.');

        return self::SUCCESS;
    }
}

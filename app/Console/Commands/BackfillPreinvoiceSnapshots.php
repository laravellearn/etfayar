<?php

namespace App\Console\Commands;

use App\Models\Preinvoice;
use Illuminate\Console\Command;

class BackfillPreinvoiceSnapshots extends Command {
    /**
     * دستور: php artisan preinvoices:backfill-snapshots
     *
     * برای رکوردهای قدیمی preinvoices/invoices که قبل از اضافه شدن
     * فیلدهای bank_* و confirmed_at ثبت شده‌اند، این مقادیر را پر می‌کند:
     *
     * 1) bank_id / bank_name / bank_account / bank_cart_code / bank_sheba:
     *    از روی حساب بانکیِ information متصل به هر رکورد کپی می‌شود.
     *
     * 2) confirmed_at:
     *    برای رکوردهایی که is_invoice = true هستند ولی confirmed_at خالی است،
     *    از updated_at (نزدیک‌ترین تاریخ ثبت‌شده‌ی موجود به لحظه‌ی تایید) استفاده
     *    می‌شود؛ اگر آن هم خالی بود از created_at استفاده می‌شود.
     *    توجه: این یک "تخمین" است، چون تاریخ دقیق تایید برای رکوردهای قدیمی
     *    قبلاً ذخیره نشده بود.
     *
     * @var string
     */
    protected $signature = 'preinvoices:backfill-snapshots {--dry-run : فقط نمایش تعداد رکوردهای تحت تاثیر، بدون ذخیره}';

    protected $description = 'پر کردن حساب بانکی اسنپ‌شات‌شده و تاریخ تایید برای رکوردهای قدیمی preinvoices/invoices';

    public function handle() {
        $dryRun = (bool) $this->option('dry-run');

        $bankUpdated = 0;
        $confirmedAtUpdated = 0;
        $skippedNoBank = 0;

        Preinvoice::withTrashed()
            ->with('information.bank')
            ->chunkById(200, function ($preinvoices) use (&$bankUpdated, &$confirmedAtUpdated, &$skippedNoBank, $dryRun) {
                foreach ($preinvoices as $preinvoice) {
                    $dirty = false;

                    // 1) اسنپ‌شات حساب بانکی
                    if (is_null($preinvoice->bank_id)) {
                        $bank = $preinvoice->information?->bank;
                        if (!is_null($bank)) {
                            $preinvoice->bank_id = $bank->id;
                            $preinvoice->bank_name = $bank->name;
                            $preinvoice->bank_account = $bank->account;
                            $preinvoice->bank_cart_code = $bank->cart_code;
                            $preinvoice->bank_sheba = $bank->sheba;
                            $bankUpdated++;
                            $dirty = true;
                        } else {
                            $skippedNoBank++;
                        }
                    }

                    // 2) تاریخ تایید
                    if ($preinvoice->is_invoice && is_null($preinvoice->confirmed_at)) {
                        $preinvoice->confirmed_at = $preinvoice->updated_at ?? $preinvoice->created_at;
                        $confirmedAtUpdated++;
                        $dirty = true;
                    }

                    if ($dirty && !$dryRun) {
                        $preinvoice->save();
                    }
                }
            });

        $prefix = $dryRun ? '[dry-run] ' : '';
        $this->info("{$prefix}حساب بانکی برای {$bankUpdated} رکورد پر شد.");
        $this->info("{$prefix}تاریخ تایید برای {$confirmedAtUpdated} رکورد پر شد.");
        if ($skippedNoBank > 0) {
            $this->warn("{$skippedNoBank} رکورد به دلیل نداشتن بانک متصل به information نادیده گرفته شد.");
        }

        return self::SUCCESS;
    }
}

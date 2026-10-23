<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangePaymentsPriceToDecimal extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        // ستون price در جدول payments از اول integer بود، یعنی اعشار مبلغ
        // واریزی (مثلاً ۱٬۵۰۰٬۰۰۰.۵۰ تومان) موقع ذخیره در MySQL گرد/قطع
        // می‌شد. اینجا با SQL خام (نه Blueprint::change()) این ستون رو
        // decimal می‌کنیم، چون پکیج doctrine/dbal که change() به‌ش نیاز
        // داره روی این پروژه نصب نیست.
        if (!Schema::hasColumn('payments', 'price')) {
            return;
        }

        if (DB::getDriverName() === 'sqlite') {
            // SQLite به‌خاطر «type affinity» مقدار اعشاری رو حتی روی ستونی
            // که با نوع «integer» ساخته شده هم به‌درستی به‌صورت REAL ذخیره
            // می‌کنه (تست شد)، پس نیازی به بازسازی جدول نیست و از ALTER
            // کردن (که در SQLite قدیمی‌تر پرریسک و محدوده) صرف‌نظر می‌کنیم.
            return;
        }

        DB::statement('ALTER TABLE `payments` MODIFY `price` DECIMAL(15,2) NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        if (!Schema::hasColumn('payments', 'price') || DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::statement('ALTER TABLE `payments` MODIFY `price` INT NULL');
    }
}

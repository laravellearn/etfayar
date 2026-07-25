<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLedgerFieldsToPaymentsAndPreinvoicesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('payments', function (Blueprint $table) {
            // تاریخ واریزی: برخلاف created_at (زمان ثبت رکورد در سیستم)، این
            // تاریخیه که مبلغ واقعاً به حساب واریز شده و فقط واحد مالی می‌تونه
            // وارد/ویرایشش کنه؛ می‌تونه هر تاریخی (گذشته یا امروز) باشه.
            $table->date('payment_date')->nullable()->after('price');

            // وضعیت تایید: 0=در انتظار تایید مالی، 1=تایید شده، 2=رد شده.
            // is_agree قبلی رو دست نمی‌زنیم (برای سازگاری با کد قبلی)، این
            // فیلد جدید امکان تفکیک «در انتظار» از «رد شده» رو می‌ده.
            $table->tinyInteger('status')->default(0)->after('is_agree');
        });

        Schema::table('preinvoices', function (Blueprint $table) {
            // تخفیفی که گاهی خودِ مشتری روی مبلغ نهایی اعمال می‌کنه؛ در محاسبه‌ی
            // «باقیمانده» در گزارش بدهکاران و بستانکاران کسر می‌شه.
            $table->bigInteger('discount')->nullable()->after('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['payment_date', 'status']);
        });

        Schema::table('preinvoices', function (Blueprint $table) {
            $table->dropColumn('discount');
        });
    }
}

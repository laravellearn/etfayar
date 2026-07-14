<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConfirmedAtAndBankSnapshotToPreinvoicesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('preinvoices', function (Blueprint $table) {
            // تاریخ تایید فاکتور (زمانی که پیش‌فاکتور به فاکتور تبدیل می‌شود)
            $table->timestamp('confirmed_at')->nullable()->after('is_invoice');

            // اسنپ‌شات حساب بانکی انتخاب‌شده برای این فاکتور به‌طور خاص.
            // این مقادیر در زمان ثبت/ویرایش فاکتور از روی حساب بانکی متصل به
            // information انتخابی کپی می‌شوند تا تغییرات بعدی در تنظیمات بانک
            // یا information، فاکتورهای قبلی را تحت تاثیر قرار ندهد.
            $table->unsignedBigInteger('bank_id')->nullable()->after('confirmed_at');
            $table->string('bank_name', 50)->nullable()->after('bank_id');
            $table->string('bank_account', 50)->nullable()->after('bank_name');
            $table->string('bank_cart_code', 50)->nullable()->after('bank_account');
            $table->string('bank_sheba', 50)->nullable()->after('bank_cart_code');

            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('preinvoices', function (Blueprint $table) {
            $table->dropForeign(['bank_id']);
            $table->dropColumn([
                'confirmed_at',
                'bank_id',
                'bank_name',
                'bank_account',
                'bank_cart_code',
                'bank_sheba',
            ]);
        });
    }
}

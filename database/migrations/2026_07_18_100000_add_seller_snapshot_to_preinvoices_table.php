<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSellerSnapshotToPreinvoicesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('preinvoices', function (Blueprint $table) {
            // اسنپ‌شات مشخصات فروشنده (information) در لحظه‌ی ثبت/ویرایش فاکتور،
            // دقیقاً مثل bank_* که قبلاً اضافه شد. این یعنی ویرایش بعدی information
            // (تغییر نام، کد اقتصادی، کد پستی، شناسه ملی، شماره ثبت)، روی فاکتورهایی
            // که قبلاً صادر شده‌اند اثر نمی‌گذارد.
            $table->string('seller_name', 255)->nullable()->after('bank_sheba');
            $table->string('seller_economic_code', 30)->nullable()->after('seller_name');
            $table->string('seller_postal_code', 20)->nullable()->after('seller_economic_code');
            $table->string('seller_national_code', 20)->nullable()->after('seller_postal_code');
            $table->string('seller_registration_number', 20)->nullable()->after('seller_national_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('preinvoices', function (Blueprint $table) {
            $table->dropColumn([
                'seller_name',
                'seller_economic_code',
                'seller_postal_code',
                'seller_national_code',
                'seller_registration_number',
            ]);
        });
    }
}

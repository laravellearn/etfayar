<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDriverAssignedAtToTransportsTable extends Migration {
    /**
     * دستور: php artisan migrate
     *
     * تا الان هیچ ستونی مشخص نمی‌کرد «کِی» یک راننده (جمع‌آوری یا تحویل) به یک
     * ترابری ارجاع داده شده؛ فقط collect_driver_id/delivery_driver_id بود که
     * نمی‌گفت این ارجاع کِی اتفاق افتاده. برای گزارش «تعداد درخواست‌های ارجاع‌شده
     * به راننده بر اساس ماه» به این تاریخ نیاز داریم.
     *
     * این ستون فقط برای اولین باری که هرکدوم از این دو فیلد ست می‌شن پر می‌شه
     * (نه هر بار تغییر راننده).
     *
     * @return void
     */
    public function up() {
        Schema::table('transports', function (Blueprint $table) {
            if (!Schema::hasColumn('transports', 'driver_assigned_at')) {
                $table->timestamp('driver_assigned_at')->nullable()->after('delivery_driver_id');
            }
        });
    }

    /**
     * @return void
     */
    public function down() {
        Schema::table('transports', function (Blueprint $table) {
            $table->dropColumn('driver_assigned_at');
        });
    }
}

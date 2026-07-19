<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransportStatusUserNotesWorkshopNoPartColumns extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        // ۱) ستون‌های وضعیت ترابری: این ستون‌ها در migration اولیه‌ی transports
        // کامنت شده بودند و هرگز واقعاً ساخته نشدند؛ به همین دلیل مدل همیشه
        // "نامشخص" نمایش می‌داد (چون این ستون‌ها اصلاً وجود نداشتند).
        // چک hasColumn برای احتیاط: اگه در دیتابیس واقعی این ستون‌ها از قبل
        // (مثلاً با SQL دستی) اضافه شده باشن، این migration خطا نده.
        Schema::table('transports', function (Blueprint $table) {
            if (!Schema::hasColumn('transports', 'status')) {
                $table->enum('status', ['waiting', 'collect', 'delivery', 'cancel', 'done'])
                    ->default('waiting')->nullable()->after('cancel_time');
            }
            if (!Schema::hasColumn('transports', 'collect_status')) {
                $table->enum('collect_status', ['waiting_for_set_collector', 'pending_collect', 'collected', 'cancel'])
                    ->nullable()->after('status');
            }
            if (!Schema::hasColumn('transports', 'delivery_status')) {
                $table->enum('delivery_status', ['waiting_for_set_deliverer', 'pending_delivery', 'delivered', 'cancel'])
                    ->nullable()->after('collect_status');
            }
        });

        // ۲) فیلد توضیحات/خصوصیات مشتری در ثبت مشتری
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'notes')) {
                $table->text('notes')->nullable()->after('email');
            }
        });

        // ۳) پرچم «مشتری داغی ندارد» برای رکورد کارگاه (workshop)
        Schema::table('workshops', function (Blueprint $table) {
            if (!Schema::hasColumn('workshops', 'has_no_fire_extinguisher_part')) {
                $table->boolean('has_no_fire_extinguisher_part')->default(false)->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('transports', function (Blueprint $table) {
            $table->dropColumn(['status', 'collect_status', 'delivery_status']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('notes');
        });

        Schema::table('workshops', function (Blueprint $table) {
            $table->dropColumn('has_no_fire_extinguisher_part');
        });
    }
}

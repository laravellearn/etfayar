<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSentDateToWorkshopItemsTable extends Migration {
    /**
     * تاریخ روزی که هر قطعه‌ی داغی اضافه/ارسال شده.
     * چون فرم «افزودن داغی‌ها» هر بار ذخیره می‌شه آیتم‌های قبلی حذف و دوباره
     * ساخته می‌شن (و ستون‌های created_at/updated_at هم برای این مدل فعال نیستن)،
     * بدون یک ستون مجزا هیچ تاریخ قابل‌اعتمادی برای «روز ارسال» هر قطعه نداریم.
     * این ستون nullable است و هیچ داده‌ی فعلی رو تحت تاثیر قرار نمی‌ده.
     *
     * @return void
     */
    public function up() {
        Schema::table('workshop_items', function (Blueprint $table) {
            if (!Schema::hasColumn('workshop_items', 'sent_date')) {
                $table->date('sent_date')->nullable()->after('count');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('workshop_items', function (Blueprint $table) {
            $table->dropColumn('sent_date');
        });
    }
}

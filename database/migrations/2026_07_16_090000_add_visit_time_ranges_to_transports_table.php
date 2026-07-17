<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVisitTimeRangesToTransportsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('transports', function (Blueprint $table) {
            // تبدیل «ساعت مراجعه» از یک فیلد تکی به دو بازه‌ی زمانی
            // (از ساعت X تا Y، و از ساعت Z تا W). ستون قدیمی visit_time
            // برای سازگاری با رکوردهای قبلی حذف نمی‌شود.
            $table->time('visit_time_from_1')->nullable()->after('visit_time');
            $table->time('visit_time_to_1')->nullable()->after('visit_time_from_1');
            $table->time('visit_time_from_2')->nullable()->after('visit_time_to_1');
            $table->time('visit_time_to_2')->nullable()->after('visit_time_from_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('transports', function (Blueprint $table) {
            $table->dropColumn([
                'visit_time_from_1',
                'visit_time_to_1',
                'visit_time_from_2',
                'visit_time_to_2',
            ]);
        });
    }
}

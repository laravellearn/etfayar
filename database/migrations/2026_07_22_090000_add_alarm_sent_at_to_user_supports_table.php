<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlarmSentAtToUserSupportsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('user_supports', function (Blueprint $table) {
            // برای جلوگیری از ارسال تکراری آلارم به ازای هر پشتیبانی: وقتی یک‌بار
            // نوتیفیکیشن «رسیدن به تاریخ پشتیبانی» ارسال شد، این فیلد پر می‌شه.
            $table->timestamp('alarm_sent_at')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('user_supports', function (Blueprint $table) {
            $table->dropColumn('alarm_sent_at');
        });
    }
}

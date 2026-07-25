<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminIdAndUrlToNotificationsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('notifications', function (Blueprint $table) {
            // برای نوتیفیکیشن‌هایی که باید فقط به یک ادمین خاص (نه یک نقش کامل)
            // برسه، مثلاً «کارشناس همین مشتری» یا «همین راننده».
            $table->unsignedBigInteger('admin_id')->nullable()->after('sender_id');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');

            // لینک مستقیم به صفحه‌ی مرتبط (مثلاً فاکتور/ترابری/داغی مربوطه)
            $table->string('url', 255)->nullable()->after('body');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropColumn(['admin_id', 'url']);
        });
    }
}

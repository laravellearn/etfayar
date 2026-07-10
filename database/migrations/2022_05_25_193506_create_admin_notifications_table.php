<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminNotificationsTable extends Migration {
    public function up() {
        Schema::create('admin_notifications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("admin_id")->unsigned()->nullable();
            $table->bigInteger("notification_id")->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('notification_id')->references('id')->on('notifications')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('admin_notifications');
    }
}

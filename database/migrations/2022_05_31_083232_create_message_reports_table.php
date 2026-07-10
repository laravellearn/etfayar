<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('message_reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->nullable();
            $table->bigInteger("admin_id")->unsigned();
            $table->string("receiver_mobile")->nullable();
            $table->text("text")->nullable();
            $table->text("data")->nullable();
            $table->text("response")->nullable();
            $table->enum("type", ['user_registered', 'request_registered', 'invoice_registered', 'custom_message', 'support_registered'])->nullable();
            $table->text('status_data')->nullable();
            $table->tinyInteger('status')->default(0)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');

        });
    }

    public function down() {
        Schema::dropIfExists('message_reports');
    }
};

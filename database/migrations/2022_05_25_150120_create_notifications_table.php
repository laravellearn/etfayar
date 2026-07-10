<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration {
    public function up() {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('body')->nullable();
            $table->text('image')->nullable();
            $table->text('roles')->nullable();
            $table->bigInteger("sender_id")->unsigned()->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('sender_id')->references('id')->on('admins')->onDelete('cascade');


        });
    }

    public function down() {
        Schema::dropIfExists('notifications');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSupportsTable extends Migration {
    public function up() {
        Schema::create('user_supports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->unsigned();
            $table->bigInteger("admin_id")->unsigned();
            $table->timestamp("support_time")->nullable();
            $table->text('create_description')->nullable();
            $table->timestamp("done_time")->nullable();
            $table->text('done_description')->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');

        });
    }

    public function down() {
        Schema::dropIfExists('user_supports');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->integer('information_id')->unsigned();
            $table->bigInteger("user_id")->unsigned();
            $table->integer('number');
            $table->text('description')->nullable();
            $table->text('attachment')->nullable();
            $table->timestamp('charge_time')->nullable();
            $table->timestamp('recharge_time')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('information_id')->references('id')->on('informations')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


        });
    }

    public function down() {
        Schema::dropIfExists('insurances');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMobileTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_mobile', function (Blueprint $table) {
            $table->bigInteger("user_id")->unsigned();
            $table->char('mobile', 11)->nullable();
            $table->char('telephone', 20)->nullable();
            $table->char('mobile_owner', 100)->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['user_id', 'mobile']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('user_mobile');
    }
}

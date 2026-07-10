<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->char('mobile', 11)->unique();
            $table->char('name', 200)->nullable();
            $table->char('family', 200)->nullable();
            $table->char('username', 200)->unique()->nullable();
            $table->char('password', 200)->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->text('pic')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0:inactive,1:active');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('admins');
    }
}

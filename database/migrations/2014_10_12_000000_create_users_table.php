<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->char('mobile', 11)->nullable()->unique();
            $table->char('name', 200)->nullable();
            $table->char('family', 200)->nullable();
            $table->char('username', 200)->unique()->nullable();
            $table->char('password', 200)->nullable();
            $table->char('telephone', 20)->nullable()->unique();
            $table->char('mobile_owner', 100)->nullable();
            $table->char('national_code', 10)->nullable();
            $table->dateTime('birthday')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->enum('identity_type', ['natural', 'legal'])->nullable();
            $table->char('customer_code', 10)->unique()->nullable();
            $table->char('company', 150)->nullable();
            $table->char('website', 150)->nullable();
            $table->char('economic_code', 30)->nullable();
            $table->char('registration_number', 20)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->bigInteger("expert_id")->nullable();
            $table->bigInteger("acquaintance_id")->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('last_login')->nullable();
            $table->text('pic')->nullable();
            $table->char('connector_name',255)->nullable();
            $table->char('connector_position',255)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('expert_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('acquaintance_id')->references('id')->on('acquaintances')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('information', function (Blueprint $table) {
            $table->id();
            $table->char('name', 255)->nullable();
            $table->text('logo')->nullable();
            $table->text('sign')->nullable();
            $table->text('header')->nullable();
            $table->text('footer')->nullable();
            $table->char('economic_code', 30)->nullable();
            $table->char('postal_code', 20)->nullable();
            $table->char('national_code', 20)->nullable();
            $table->char('registration_number', 20)->nullable();
            $table->bigInteger('city_id')->nullable();
            $table->char('area', 255)->nullable();
            $table->char('postal_box', 20)->nullable();
            $table->text('address')->nullable();
            $table->text('location')->nullable();
            $table->char('telephone', 20)->nullable();
            $table->bigInteger('bank_id')->nullable();
            $table->tinyInteger('type')->default(0);
            $table->tinyInteger('header_type')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('information');
    }
}

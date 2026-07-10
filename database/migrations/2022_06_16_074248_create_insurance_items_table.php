<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsuranceItemsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('insurance_items', function (Blueprint $table) {
            $table->id();
            $table->integer('insurance_id')->unsigned();
            $table->bigInteger("product_id")->unsigned();
            $table->integer('number');
            $table->timestamps();

            $table->foreign('insurance_id')->references('id')->on('insurances')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('insurance_items');
    }
}

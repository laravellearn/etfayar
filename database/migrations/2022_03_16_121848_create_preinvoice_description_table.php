<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreinvoiceDescriptionTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('preinvoice_description', function (Blueprint $table) {
            $table->bigInteger("preinvoice_id")->unsigned();
            $table->bigInteger("description_id")->unsigned();

            $table->foreign('preinvoice_id')->references('id')->on('preinvoices')->onDelete('cascade');
            $table->foreign('description_id')->references('id')->on('descriptions')->onDelete('cascade');

            $table->primary(['preinvoice_id', 'description_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('preinvoice_description');
    }
}

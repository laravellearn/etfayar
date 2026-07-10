<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreinvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preinvoice_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("preinvoice_id")->unsigned();
            $table->bigInteger("product_id")->unsigned();
            $table->text('title')->nullable();
            $table->integer('count')->default(1);
            $table->bigInteger('price');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('preinvoice_id')->references('id')->on('preinvoices')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preinvoice_items');
    }
}

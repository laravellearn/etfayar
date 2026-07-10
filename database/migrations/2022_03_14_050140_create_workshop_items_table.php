<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshop_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("workshop_id")->unsigned();
            $table->bigInteger("fire_extinguisher_part_id")->unsigned();
            $table->char('title', 500)->nullable();
            $table->integer('count')->default(0);
            $table->integer('price')->default(0);
            $table->timestamps();

            $table->foreign('workshop_id')->references('id')->on('workshops')->onDelete('cascade');
            $table->foreign('fire_extinguisher_part_id')->references('id')->on('fire_extinguisher_parts')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workshop_items');
    }
}

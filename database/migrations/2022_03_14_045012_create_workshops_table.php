<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopsTable extends Migration {
    /**
     * Run the migrations.
     *     * @return void
     */
    public function up() {
        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("preinvoice_id")->unsigned()->nullable();
            $table->text("description")->nullable();
            $table->tinyInteger('status')->default(0)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('preinvoice_id')->references('id')->on('preinvoices')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('workshops');
    }
}

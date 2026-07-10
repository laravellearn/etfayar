<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormItemTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('form_item', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("office_form_id")->unsigned()->nullable();
            $table->string('element', 255);
            $table->string('label', 255)->nullable();
            $table->string('element_id', 255)->nullable();
            $table->string('class', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->string('name', 255);
            $table->text('value')->nullable();
            $table->string('placeholder', 255)->nullable();
            $table->boolean('disabled',)->default(false);
            $table->boolean('is_essential',)->default(false);
            $table->string('block_id',)->nullable();
            $table->string('block_class',)->nullable();
            $table->boolean('is_multiple',)->default(false);
            $table->tinyInteger("status")->default(1)->nullable();
            $table->tinyInteger("position")->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('office_form_id')->references('id')->on('office_forms')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('form_item');
    }
}

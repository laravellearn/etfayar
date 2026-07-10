<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeFormsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('office_forms', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('action');
            $table->string('method', 10);
            $table->string('form_id');
            $table->string('form_class');
            $table->text('roles');
            $table->string('enctype');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('office_forms');
    }
}

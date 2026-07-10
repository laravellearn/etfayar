<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->char('title', 100)->nullable();
            $table->text('icon')->nullable();
            $table->enum('type', ['divider', 'menu', 'sub_menu'])->nullable();
            $table->text('url')->nullable();
            $table->char('permission_title', 100)->nullable();
            $table->integer('parent_code')->nullable();
            $table->integer('position')->nullable();
            $table->tinyInteger('status')->default(1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('menus');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('custom_invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("preinvoice_id")->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->text('header')->nullable();
            $table->tinyInteger('increase_percent_per_item')->nullable();
            $table->text('items_order')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('type')->default(1);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('preinvoice_id')->references('id')->on('preinvoices')->onDelete('cascade');

        });
    }

    public function down() {
        Schema::dropIfExists('custom_invoices');
    }
};

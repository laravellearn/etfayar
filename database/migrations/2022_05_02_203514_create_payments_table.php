<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("admin_id")->unsigned();
            $table->bigInteger("invoice_id")->unsigned();
            $table->bigInteger("bank_id")->unsigned();
            $table->integer("price")->nullable();
            $table->text("payment_receipt")->nullable();
            $table->boolean("is_deposit")->default(false);
            $table->text('description')->nullable();
            $table->tinyInteger("type")->default(1);
            $table->boolean("is_agree")->default(false);
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('invoice_id')->references('id')->on('preinvoices')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('payments');
    }
}

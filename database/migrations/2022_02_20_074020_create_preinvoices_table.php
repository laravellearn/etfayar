<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreinvoicesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('preinvoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("request_id")->unsigned();
            $table->char('code', 10)->unique()->nullable();
            $table->string('title')->nullable();
            $table->text('logo')->nullable();
            $table->text('sign')->nullable();
            $table->text('header')->nullable();
            $table->integer('information_id')->default(0);
            $table->text('description')->nullable();
            $table->integer('tax')->default(0);
            $table->integer('dues')->default(0);
            $table->bigInteger('price')->nullable();
            $table->boolean('is_invoice')->default(false)->nullable();
            $table->enum('status', ['pending', 'transport', 'financial', 'cancel'])->default('pending');
            $table->enum('transport_status', ['sendToDriver', 'backToExpertFromTransporter', 'uploadedChargeReceipt', 'uploadedPaymentReceipt'])->nullable();
            $table->enum('workshop_status', ['sendToDriver', 'SavedFireExtinguisherPart', 'backToExpertFromTransporter'])->nullable();
            $table->enum('financial_status', ['changeToFactor', 'paymentFactor', 'notPaymentFactor', 'cancelFactor'])->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('request_id')->references('id')->on('user_requests')->onDelete('cascade');
            $table->foreign('information_id')->references('id')->on('informations')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }
}

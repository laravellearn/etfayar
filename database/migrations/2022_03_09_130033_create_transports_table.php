<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('transports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("admin_id")->unsigned();
            $table->bigInteger("collect_driver_id")->unsigned()->nullable();
            $table->bigInteger("delivery_driver_id")->unsigned()->nullable();
            $table->bigInteger("preinvoice_id")->unsigned();
            $table->date('visit_date')->nullable();
            $table->time('visit_time')->nullable();
            $table->integer('delivery_duration')->nullable();
            $table->boolean('is_fiduciary')->default(false)->nullable();
            $table->text('description')->nullable();
            $table->text("charge_receipt_file")->nullable();
            $table->text('collect_description')->nullable();
            $table->timestamp('collect_time')->nullable();
            //$table->date('collect_date')->nullable();
            //$table->boolean('is_done_collect')->default(false)->nullable();
            //$table->date('delivery_date')->nullable();
            $table->timestamp('delivery_time')->nullable();
            $table->text('delivery_description')->nullable();
            $table->timestamp('cancel_time')->nullable();
            //$table->boolean('is_done_delivery')->default(false)->nullable();
            //$table->enum('status', ['waiting', 'collect', 'delivery', 'cancel', 'done'])->default('waiting')->nullable();
            //$table->enum('collect_status', ['waiting_for_set_collector', 'pending_collect', 'collected', 'cancel'])->default('waiting')->nullable();
            //$table->enum('delivery_status', ['waiting_for_set_deliverer', 'pending_delivery', 'delivered', 'cancel'])->default('waiting')->nullable();
            //$table->boolean('is_done_task')->default(false)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('collect_driver_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('delivery_driver_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('preinvoice_id')->references('id')->on('preinvoices')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('transports');
    }
}

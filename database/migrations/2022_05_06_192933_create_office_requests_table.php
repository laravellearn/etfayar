<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeRequestsTable extends Migration {
    public function up() {
        Schema::create('office_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("office_form_id")->unsigned()->nullable();
            $table->bigInteger("applicant_id")->unsigned()->nullable();
            $table->bigInteger("recipient_id")->unsigned()->nullable();
            $table->integer("number")->unsigned()->nullable();
            $table->json("data_json")->nullable();
            $table->text("data_text")->nullable();
            $table->timestamp("view_date")->nullable();
            $table->timestamp("status_date")->nullable();
            $table->enum('status', ['not_seen', 'pending', 'agree', 'deny'])->default('waiting')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('office_form_id')->references('id')->on('office_forms')->onDelete('cascade');
            $table->foreign('applicant_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('recipient_id')->references('id')->on('admins')->onDelete('cascade');

        });
    }

    public function down() {
        Schema::dropIfExists('office_requests');
    }
}

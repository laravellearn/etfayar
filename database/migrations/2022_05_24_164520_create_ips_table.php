<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpsTable extends Migration {
    public function up() {
        Schema::create('ips', function (Blueprint $table) {
            $table->id();
            $table->string('address', 20)->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['valid', 'invalid'])->default('valid');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('ips');
    }
}

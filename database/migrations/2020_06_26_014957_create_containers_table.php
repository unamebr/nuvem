<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContainersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('containers', function (Blueprint $table) {
            $table->id();
            $table->string('hashcode_maquina');
            $table->string('docker_id')->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('image_id');
            $table->string('nickname', 256)->unique();
            $table->string('status')->nullable(true);
            $table->string('state')->nullable(true);
            $table->string('ports')->nullable(true);

            $table->foreign('hashcode_maquina')->references('hashcode')->on('maquinas');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('image_id')->references('id')->on('images');

            $table->dateTime('dataHora_instanciado');
            $table->dateTime('dataHora_finalizado')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('containers');
    }
}

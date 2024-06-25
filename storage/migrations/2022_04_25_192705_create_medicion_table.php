<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('latitud');
            $table->string('longitud');
            $table->string('direccion');
            $table->string('referencia');
            $table->integer('consumo')->nullable();
            $table->integer('consumoReal')->nullable();
            $table->double('total',8,2)->nullable();
            $table->unsignedInteger('idMensualidad');
            $table->foreign('idMensualidad')->references('id')->on('mensualidad');
            $table->unsignedInteger('idAdministrador');
            $table->foreign('idAdministrador')->references('id')->on('users');
            $table->unsignedInteger('idColaborador');
            $table->foreign('idColaborador')->references('id')->on('colaborador');
            $table->unsignedInteger('idCliente');
            $table->foreign('idCliente')->references('id')->on('cliente');
            $table->integer('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicion');
    }
};

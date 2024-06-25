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
        Schema::create('cliente', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('perfil')->nullable();
            $table->string('ci');
            $table->string('email');
            $table->string('password');
            $table->string('celular');
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->string('direccion');
            $table->string('referencia');
            $table->string('nit');
            $table->string('nombreFactura');
            $table->string('tokenFirebase')->nullable();
            $table->string('codigoRecuperacion')->nullable();
            $table->unsignedInteger('idCiudad');
            $table->foreign('idCiudad')->references('id')->on('ciudad');
            $table->tinyInteger('eliminado');
            $table->tinyInteger('inhabilitado');
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
        Schema::dropIfExists('cliente');
    }
};

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
        Schema::create('mensualidad', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->unsignedInteger('idGestion');
            $table->foreign('idGestion')->references('id')->on('gestion');
            $table->tinyInteger('eliminado');
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
        Schema::dropIfExists('mensualidad');
    }
};

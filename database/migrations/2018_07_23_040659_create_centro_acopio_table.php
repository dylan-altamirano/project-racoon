<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentroAcopioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centro_acopios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('direccion_exacta');
            $table->boolean('activo')->default(true);
            $table->string('provincia');
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
        Schema::dropIfExists('centro_acopio');
    }
}

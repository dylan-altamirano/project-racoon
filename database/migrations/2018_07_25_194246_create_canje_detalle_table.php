<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanjeDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canje_detalle', function (Blueprint $table) {
            $table->unsignedInteger('canje_id');
            $table->unsignedInteger('material_id');
            $table->integer('cantidad');
            $table->timestamps();

            //PK
            $table->unique(['canje_id','material_id']);

            //FK
            $table->foreign('canje_id')->references('id')->on('canjes')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('materiales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('canje_detalle', function (Blueprint $table){
            $table->dropForeign('canje_detalle_canje_id_foreign');
            $table->dropColumn('canje_id');
            $table->dropForeign('canje_detalle_material_id_foreign');
            $table->dropColumn('material_id');
        });


        Schema::dropIfExists('canje_detalle');
    }
}

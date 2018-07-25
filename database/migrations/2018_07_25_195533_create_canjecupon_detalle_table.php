<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanjecuponDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canjecupon_detalle', function (Blueprint $table) {
            $table->unsignedInteger('canjecupon_id');
            $table->unsignedInteger('cupon_id');
            $table->integer('cantidad');
            $table->timestamps();

            //PK
            $table->unique(['canjecupon_id','cupon_id']);

            //FK
            $table->foreign('canjecupon_id')->references('id')->on('canjecupones')->onDelete('cascade');
            $table->foreign('cupon_id')->references('id')->on('cupones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::table('canjecupon_detalle', function (Blueprint $table){
            $table->dropForeign('canjecupon_detalle_canjecupon_id_foreign');
            $table->dropColumn('canjecupon_id');
            $table->dropForeign('canjecupon_detalle_cupon_id_foreign');
            $table->dropColumn('cupon_id');
        });

        Schema::dropIfExists('canjecupon_detalle');
    }
}

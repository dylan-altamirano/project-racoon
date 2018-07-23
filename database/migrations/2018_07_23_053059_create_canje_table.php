<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanjeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canjes', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');

            //Se asocia con un usuario
            $table->unsignedInteger('user_id');

            // Se asocia con un centro de acopio
            $table->unsignedInteger('centro_acopio_id');

            $table->timestamps();

            /***LLaves foráneas***/
            //Con usuario
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            //Con el centro de acopio
            $table->foreign('centro_acopio_id')->references('id')->on('centro_acopios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('canjes', function (Blueprint $table){
            $table->dropForeign('canjes_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('canjes_centro_acopio_id_foreign');
            $table->dropColumn('centro_acopio_id');
        });

        Schema::dropIfExists('canjes');
    }
}

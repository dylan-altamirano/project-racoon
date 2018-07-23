<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanjecuponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canjecupones', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->boolean('activo');

             //Se asocia con un usuario
            $table->unsignedInteger('user_id');

            $table->timestamps();

             /***LLaves foráneas***/
            //Con usuario
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('canjecupones', function (Blueprint $table){
            $table->dropForeign('canjecupones_user_id_foreign');
            $table->dropColumn('user_id');
        });

        Schema::dropIfExists('canjecupones');
    }
}

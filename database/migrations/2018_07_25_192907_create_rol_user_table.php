<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol_user', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('rol_id');
            $table->timestamps();

            //Llave primaria
            $table->unique(['user_id','rol_id']);

            //LLave foránea
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('rol_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rol_user', function (Blueprint $table){
            $table->dropForeign('rol_user_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('rol_user_rol_id_foreign');
            $table->dropColumn('rol_id');
        });

        Schema::dropIfExists('rol_user');
    }
}

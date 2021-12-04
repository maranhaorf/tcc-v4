<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Createestoque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoque', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_produto')->unique();;
            $table->foreign('id_produto')->references('id')->on('produto');
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->double('quantidade');
            $table->double('estoque_minimo');
            $table->softDeletes();
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
        Schema::dropIfExists('estoque');
    }
}

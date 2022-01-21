<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrcamentoPedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orcamento_pedido', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_produto');
            $table->foreign('id_produto')->references('id')->on('produto');
            $table->integer('quantidade');
            $table->string('preco');
            $table->unsignedBigInteger('id_orcamento');
            $table->foreign('id_orcamento')->references('id')->on('solicitacao_orcamento');
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
        Schema::dropIfExists('orcamento_pedido');
    }
}

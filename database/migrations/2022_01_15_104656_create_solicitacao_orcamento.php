<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitacaoOrcamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacao_orcamento', function (Blueprint $table) {
            $table->id();
            $table->string('nome_cliente');
            $table->string('cpf_cliente');
            $table->string('email_cliente');
            $table->string('telefone_cliente');
            $table->string('status')->default('Criado');
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
        Schema::dropIfExists('solicitacao_orcamento');
    }
}

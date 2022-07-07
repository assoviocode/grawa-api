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
        Schema::create('cliente', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('nome', 255)->nullable();
            $table->string('cnpj', 14)->nullable();
            $table->string('razao_social', 255)->nullable();
            $table->string('telefone', 45)->nullable();
            $table->string('endereco', 255)->nullable();
            $table->string('responsavel_cpf', 45)->nullable();
            $table->string('responsavel_nome', 255)->nullable();
            $table->string('responsavel_telefone', 45)->nullable();
            $table->string('responsavel_email', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('cidade_id')->nullable();
            $table->foreign('cidade_id')->references('id')->on('cidade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente');
    }
};

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
        Schema::create('tarefa', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('nome', 255)->nullable();
            $table->integer('previsao')->nullable();
            $table->date('dt_previsao_inicio')->nullable();
            $table->date('dt_previsao_termino')->nullable();
            $table->date('dt_inicio')->nullable();
            $table->date('dt_termino')->nullable();
            $table->boolean('extra')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('responsavel_id');
            $table->foreign('responsavel_id')->references('id')->on('usuario');

            $table->unsignedBigInteger('modulo_id');
            $table->foreign('modulo_id')->references('id')->on('modulo');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarefa');
    }
};

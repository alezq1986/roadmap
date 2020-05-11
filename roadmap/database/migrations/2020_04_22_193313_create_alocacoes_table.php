<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlocacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alocacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('atividade_id')->constrained();
            $table->foreignId('recurso_id')->constrained();
            $table->date('data_inicio_proj');
            $table->date('data_fim_proj');
            $table->foreignId('roadmap_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('alocacoes');
    }
}

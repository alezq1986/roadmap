<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividades', function (Blueprint $table) {
            $table->id();
            $table->integer('atividade_codigo');
            $table->foreignId('projeto_id')->constrained()->onDelete('cascade');
            $table->string('descricao', 100);
            $table->foreignId('competencia_id')->constrained();
            $table->foreignId('recurso_real_id')->nullable()->constrained('recursos');
            $table->integer('prazo');
            $table->date('data_inicio_real')->nullable();
            $table->date('data_fim_real')->nullable();
            $table->decimal('percentual_real', 5, 2);
            $table->unique(['atividade_codigo', 'projeto_id']);
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
        Schema::dropIfExists('atividades');
    }
}

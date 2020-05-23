<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetenciaRecursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competencia_recurso', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competencia_id')->constrained()->onDelete('cascade');;
            $table->foreignId('recurso_id')->constrained()->onDelete('cascade');;
            $table->char('permite_aloc_automatica');
            $table->unique(['recurso_id', 'competencia_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competencia_recurso', function (Blueprint $table) {
            Schema::dropIfExists('competencia_recurso');
        });
    }
}

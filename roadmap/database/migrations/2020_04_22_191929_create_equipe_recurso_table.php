<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipeRecursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipe_recurso', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipe_id')->constrained();
            $table->foreignId('recurso_id')->constrained();
            $table->unique(['equipe_id', 'recurso_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('equipe_recurso', function (Blueprint $table) {
            Schema::dropIfExists('equipe_recurso');
        });
    }
}

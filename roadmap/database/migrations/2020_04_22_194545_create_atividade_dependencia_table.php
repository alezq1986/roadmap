<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtividadeDependenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividade_dependencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('atividade_id')->constrained()->onDelete('cascade');
            $table->foreignId('dependencia_id')->constrained('atividades')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('atividade_dependencia', function (Blueprint $table) {
            Schema::dropIfExists('atividade_dependencia');
        });
    }
}

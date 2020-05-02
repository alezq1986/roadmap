<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtividadeRoadmapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividade_roadmap', function (Blueprint $table) {
            $table->id();
            $table->foreignId('atividade_id')->constrained();
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
        Schema::table('atividade_roadmap', function (Blueprint $table) {
            Schema::dropIfExists('atividade_roadmap');
        });
    }
}

<?php

use App\Atividade;
use App\Projeto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AtividadeDependenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::update(DB::raw('truncate table atividade_dependencia restart identity cascade'));

        $projetos = Projeto::all();

        foreach ($projetos as $projeto) {

            Atividade::criarDependencias($projeto);

        }
    }
}

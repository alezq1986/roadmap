<?php

use App\Competencia;
use Illuminate\Database\Seeder;

class CompetenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::update(DB::raw('truncate table competencias restart identity cascade'));

        Competencia::create(['descricao' => 'Desenvolvimento Manager']);
        Competencia::create(['descricao' => 'Desenvolvimento PDV']);
        Competencia::create(['descricao' => 'Desenvolvimento Mobile']);
        Competencia::create(['descricao' => 'Análise de Negócio']);
        Competencia::create(['descricao' => 'Teste']);
        Competencia::create(['descricao' => 'Revisão Manager']);
        Competencia::create(['descricao' => 'Revisão PDV']);
        Competencia::create(['descricao' => 'Revisão Mobile']);
    }
}

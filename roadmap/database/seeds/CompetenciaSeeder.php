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
        $c1 = Competencia::create(['descricao' => 'Desenvolvimento Manager']);
        $c2 = Competencia::create(['descricao' => 'Desenvolvimento PDV']);
        $c3 = Competencia::create(['descricao' => 'Desenvolvimento Mobile']);
        $c4 = Competencia::create(['descricao' => 'Análise de Negócio']);
        $c5 = Competencia::create(['descricao' => 'Teste']);
        $c6 = Competencia::create(['descricao' => 'Revisão Manager']);
        $c7 = Competencia::create(['descricao' => 'Revisão PDV']);
        $c8 = Competencia::create(['descricao' => 'Revisão Mobile']);
    }
}

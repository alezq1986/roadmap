<?php

use Illuminate\Database\Seeder;

class AlocacoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ar1 = DB::table('alocacoes')->insert([
            'atividade_id' => 1,
            'recurso_id' => 1,
            'data_inicio_proj' => '2020-01-10',
            'data_fim_proj' => '2020-01-20',
            'roadmap_id' => 1
        ]);
        $ar2 = DB::table('alocacoes')->insert([
            'atividade_id' => 2,
            'recurso_id' => 1,
            'data_inicio_proj' => '2020-03-16',
            'data_fim_proj' => '2020-03-20',
            'roadmap_id' => 1
        ]);
        $ar3 = DB::table('alocacoes')->insert([
            'atividade_id' => 3,
            'recurso_id' => 1,
            'data_inicio_proj' => '2020-03-31',
            'data_fim_proj' => '2020-04-13',
            'roadmap_id' => 1
        ]);
        $ar4 = DB::table('alocacoes')->insert([
            'atividade_id' => 4,
            'recurso_id' => 1,
            'data_inicio_proj' => '2020-04-14',
            'data_fim_proj' => '2020-04-28',
            'roadmap_id' => 1
        ]);
        $ar5 = DB::table('alocacoes')->insert([
            'atividade_id' => 5,
            'recurso_id' => 5,
            'data_inicio_proj' => '2020-04-29',
            'data_fim_proj' => '2020-05-13',
            'roadmap_id' => 1
        ]);
    }
}

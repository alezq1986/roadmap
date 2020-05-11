<?php

use App\Atividade;
use Illuminate\Database\Seeder;

class AtividadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a1 = Atividade::create(['descricao' => 'Análise de Negócio', 'atividade_codigo' => 1, 'projeto_id' => 1, 'competencia_id' => 4, 'prazo' => 5, 'data_inicio_real' => '2020-01-10', 'data_fim_real' => '2020-01-20', 'percentual_real' => 100.00]);
        $a2 = Atividade::create(['descricao' => 'Análise de Negócio', 'atividade_codigo' => 1, 'projeto_id' => 2, 'competencia_id' => 4, 'prazo' => 5, 'data_inicio_real' => '2020-03-16', 'data_fim_real' => '2020-03-20', 'percentual_real' => 100.00]);
        $a3 = Atividade::create(['descricao' => 'Análise de Negócio', 'atividade_codigo' => 1, 'projeto_id' => 3, 'competencia_id' => 4, 'prazo' => 8, 'data_inicio_real' => '2020-03-31', 'data_fim_real' => null, 'percentual_real' => 20.00]);
        $a4 = Atividade::create(['descricao' => 'Análise de Negócio', 'atividade_codigo' => 1, 'projeto_id' => 4, 'competencia_id' => 4, 'prazo' => 10, 'data_inicio_real' => null, 'data_fim_real' => null, 'percentual_real' => 0]);
        $a5 = Atividade::create(['descricao' => 'Desenvolvimento Manager', 'atividade_codigo' => 2, 'projeto_id' => 4, 'competencia_id' => 1, 'prazo' => 10, 'data_inicio_real' => null, 'data_fim_real' => null, 'percentual_real' => 0]);
        $a5 = Atividade::create(['descricao' => 'Teste', 'atividade_codigo' => 3, 'projeto_id' => 2, 'competencia_id' => 5, 'prazo' => 10, 'data_inicio_real' => null, 'data_fim_real' => null, 'percentual_real' => 0]);
    }
}

<?php

use App\Atividade;
use Illuminate\Database\Seeder;

class AtividadeDependenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $atividades = Atividade::all();

        foreach ($atividades as $atividade) {

            $ap = array();

            switch ($atividade->competencia->id) {

                case 1:

                    $ap = [4];

                    break;

                case 2:

                    $ap = [4];

                    break;

                case 3:

                    $ap = [4];

                    break;

                case 4:

                    break;

                case 5:
                    if ($atividade->descricao != 'Teste Master') {
                        $ap = [1, 2, 3];
                    } else {
                        $ap = [5];
                    }


                    break;

                case 6:

                    $ap = [1];

                    break;

                case 7:

                    $ap = [2];

                    break;

                case 8:

                    $ap = [3];

                    break;
            }

            if ($atividade->descricao != 'Teste Master') {

                $atividades_predecessoras = Atividade::where('projeto_id', '=', $atividade->projeto->id)->whereIn
                ('competencia_id', $ap)->get();

            } else {

                $atividades_predecessoras = Atividade::where('projeto_id', '=', $atividade->projeto->id)->whereIn
                ('competencia_id', $ap)->where('descricao', '=', 'Teste Ramo')->get();

            }

            if ($atividades_predecessoras->isNotEmpty()) {

                foreach ($atividades_predecessoras as $atividade_predecessora) {

                    $ap = DB::table('atividade_dependencia')->insert([
                        'atividade_id' => $atividade->id,
                        'dependencia_id' => $atividade_predecessora->id
                    ]);

                }
            }

        }

    }
}

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

            $atividades = $projeto->atividades;

            if ($atividades->count() == 0) {

                return null;
            }

            $contador_testes = 0;

            foreach ($atividades as $atividade) {

                if ($atividade->competencia_id == 5) {

                    $contador_testes++;
                }

                $ap = array();

                switch ($atividade->competencia_id) {

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
                        if ($contador_testes > 1) {

                            $ap = [5];

                        } else {

                            $ap = [1, 2, 3];

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

                if ($contador_testes > 1 && $atividade->competencia_id == 5) {

                    $atividades_predecessoras = Atividade::where('projeto_id', '=', $atividade->projeto->id)->whereIn
                    ('competencia_id', $ap)->orderBy('atividade_codigo', 'ASC')->skip($contador_testes - 2)->limit(1)->get();

                } else {

                    $atividades_predecessoras = Atividade::where('projeto_id', '=', $atividade->projeto->id)->whereIn
                    ('competencia_id', $ap)->get();

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
}

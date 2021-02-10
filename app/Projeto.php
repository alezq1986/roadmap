<?php

namespace App;

use App\Atividade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isNull;

class Projeto extends Model
{
    protected $fillable = ['descricao', 'equipe_id', 'status', 'status_aprovacao'];

    public function atividades()
    {
        return $this->hasMany('App\Atividade')->orderBy('atividade_codigo', 'ASC');
    }

    public function equipe()
    {
        return $this->hasOne('App\Equipe');
    }

    public function roadmaps()
    {
        return $this->belongsToMany('App\Roadmap');
    }

    public static function criarProjeto(Request $request)
    {
        try {

            $resultado = DB::transaction(function () use ($request) {

                $projeto = Projeto::create([
                    'descricao' => $request->input('descricao'),
                    'status' => 0,
                    'status_aprovacao' => $request->input('status_aprovacao'),
                    'equipe_id' => $request->input('equipe_id'),
                    'data_entrega' => $request->input('data_entrega'),
                ]);


                if ($request->session()->has('filhos')) {

                    FuncoesFilhos::criarFilhos($request, $projeto);

                    Atividade::criarDependencias($projeto);

                }

                return $projeto;

            });

            return $resultado;

        } catch (Exception $e) {

            return 1;

        }
    }

    public static function atualizarProjeto(Request $request, Projeto $projeto)
    {
        try {

            $resultado = DB::transaction(function () use ($request, $projeto) {

                $projeto->descricao = $request->input('descricao');
                $projeto->equipe_id = $request->input('equipe_id');
                $projeto->status = $request->input('status');
                $projeto->status_aprovacao = $request->input('status_aprovacao');
                $projeto->data_entrega = $request->input('data_entrega');

                $projeto->save();

                if ($request->session()->has('filhos')) {

                    FuncoesFilhos::criarFilhos($request, $projeto);

                    Atividade::criarDependencias($projeto);


                }

                return $projeto;

            });

            return $resultado;

        } catch (Exception $e) {

            Log::error('atualizarProjeto', ['projeto' => $projeto, 'erro' => $e]);

            return false;

        }
    }

    function atualizarStatusProjeto()
    {
        $atividades = $this->atividades;

        $at_totais = $atividades->count();

        $at_totais_iniciadas = 0;

        $at_totais_completas = 0;

        $at_testes_iniciadas = 0;

        foreach ($atividades as $atividade) {

            if ($atividade->percentual_real == 100) {

                $at_totais_completas++;

                $at_totais_iniciadas++;

                if ($atividade->competencia_id == 5) {

                    $at_testes_iniciadas++;

                }

            } elseif ($atividade->percentual_real == 0) {


            } else {

                $at_totais_iniciadas++;

                if ($atividade->competencia_id == 5) {

                    $at_testes_iniciadas++;

                }

            }

        }

        if ($at_totais == $at_totais_completas) {

            $this->status = 3;

        } elseif ($at_testes_iniciadas) {

            $this->status = 2;

        } elseif ($at_totais_iniciadas) {

            $this->status = 1;

        } else {

            $this->status = 0;
        }

        $this->save();

        return $this;

    }

    public static function importarProjetosExcel(){


        try {

            $tipo = 'Xlsx';

            $diretorio = Storage::path('public/projetos.xlsx');

            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($tipo);

            $reader->setReadDataOnly(true);

            $arquivo = $reader->load($diretorio);

            $planilha = $arquivo->getActiveSheet();

            $lin = 1;

            $lin_f = 8;

            $cel = $planilha->getCell('A'.$lin)->getValue();

            $projetos_criados = array();

            while(!is_null($cel)){

                $proj_range = $planilha->rangeToArray('A'.$lin.':B'.$lin_f);

                $at_codigo = 1;

                if (is_null($proj_range[0][1]) || is_null($proj_range[1][1]) || is_null($proj_range[2][1])){


                } else {

                    if (is_null(Projeto::where('descricao', '=', $proj_range[0][1])->first())){

                        $projeto = Projeto::create([
                            'descricao' => $proj_range[0][1],
                            'status' => '0',
                            'status_aprovacao' => $proj_range[2][1],
                            'equipe_id' => intval($proj_range[1][1])
                        ]);

                        array_push($projetos_criados, $projeto->descricao);

                        if (!is_null($proj_range[3][1]) && intval($proj_range[3][1]) > 0) {

                            $at_analise = Atividade::create([
                                'descricao' => 'Análise de Negócio',
                                'competencia_id' => 4,
                                'projeto_id' => $projeto->id,
                                'prazo' => intval($proj_range[3][1]),
                                'atividade_codigo' => $at_codigo,
                                'percentual_real'=> 0
                            ]);

                            $at_codigo++;

                        }

                        if (!is_null($proj_range[4][1]) && intval($proj_range[4][1]) > 0) {

                            $at_manager = Atividade::create([
                                'descricao' => 'Desenvolvimento Manager',
                                'competencia_id' => 5,
                                'projeto_id' => $projeto->id,
                                'prazo' => intval($proj_range[4][1]),
                                'atividade_codigo' => $at_codigo,
                                'percentual_real'=> 0
                            ]);

                            $at_codigo++;

                            $prazo_revmanager = max(1, round(intval($proj_range[4][1])*0.15,0));

                            $at_revmanager = Atividade::create([
                                'descricao' => 'Revisão Manager',
                                'competencia_id' => 6,
                                'projeto_id' => $projeto->id,
                                'prazo' => $prazo_revmanager,
                                'atividade_codigo' => $at_codigo,
                                'percentual_real'=> 0
                            ]);

                            $at_codigo++;
                        }

                        if (!is_null($proj_range[5][1]) && intval($proj_range[5][1]) > 0) {

                            $at_pdv = Atividade::create([
                                'descricao' => 'Desenvolvimento PDV',
                                'competencia_id' => 2,
                                'projeto_id' => $projeto->id,
                                'prazo' => intval($proj_range[5][1]),
                                'atividade_codigo' => $at_codigo,
                                'percentual_real'=> 0
                            ]);

                            $at_codigo++;

                            $prazo_revpdv = max(1, round(intval($proj_range[5][1])*0.15,0));

                            $at_revpdv = Atividade::create([
                                'descricao' => 'Revisão PDV',
                                'competencia_id' => 7,
                                'projeto_id' => $projeto->id,
                                'prazo' => $prazo_revpdv,
                                'atividade_codigo' => $at_codigo,
                                'percentual_real'=> 0
                            ]);

                            $at_codigo++;
                        }

                        if (!is_null($proj_range[6][1]) && intval($proj_range[6][1]) > 0) {

                            $at_mobile = Atividade::create([
                                'descricao' => 'Desenvolvimento Mobile',
                                'competencia_id' => 3,
                                'projeto_id' => $projeto->id,
                                'prazo' => intval($proj_range[6][1]),
                                'atividade_codigo' => $at_codigo,
                                'percentual_real'=> 0
                            ]);

                            $at_codigo++;

                            $prazo_revmobile = max(1, round(intval($proj_range[6][1])*0.15,0));

                            $at_revmobile = Atividade::create([
                                'descricao' => 'Revisão Mobile',
                                'competencia_id' => 8,
                                'projeto_id' => $projeto->id,
                                'prazo' => $prazo_revmobile,
                                'atividade_codigo' => $at_codigo,
                                'percentual_real'=> 0
                            ]);

                            $at_codigo++;
                        }

                        if (!is_null($proj_range[7][1]) && intval($proj_range[7][1]) > 0) {

                            $at_testeramo = Atividade::create([
                                'descricao' => 'Teste Ramo',
                                'competencia_id' => 5,
                                'projeto_id' => $projeto->id,
                                'prazo' => intval($proj_range[7][1]),
                                'atividade_codigo' => $at_codigo,
                                'percentual_real'=> 0
                            ]);

                            $at_codigo++;

                            if (!is_null($proj_range[4][1]) && intval($proj_range[4][1]) > 0) {

                                $prazo_testemaster = max(1, round(intval($proj_range[7][1])*0.15,0));

                                $at_testemaster = Atividade::create([
                                    'descricao' => 'Teste Master',
                                    'competencia_id' => 8,
                                    'projeto_id' => $projeto->id,
                                    'prazo' => $prazo_testemaster,
                                    'atividade_codigo' => $at_codigo,
                                    'percentual_real'=> 0
                                ]);

                            }

                        }


                    }

                }

                $lin += 8;

                $lin_f += 8;

                $cel = $planilha->getCell('A'.$lin)->getValue();

            }

            return $projetos_criados;


        } catch (\Exception $e){


            Log::error('importarProjetosExcel', ['proj' => $proj_range, 'erro' => $e]);

            return false;

        }


    }

}



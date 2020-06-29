<?php

namespace App;

use App\Atividade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

                    if (isset($request->session()->get('filhos')['filhos_incluir'])) {

                        Atividade::criarDependencias($projeto);

                    }
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

                    if (isset($request->session()->get('filhos')['filhos_incluir'])) {

                        Atividade::criarDependencias($projeto);

                    }

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

}



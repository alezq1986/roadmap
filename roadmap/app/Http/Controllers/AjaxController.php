<?php

namespace App\Http\Controllers;

use App\Roadmap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jobs\alocarRoadmap;
use Illuminate\Support\Facades\Log;

class AjaxController extends Controller
{

    public function consultar(Request $request)
    {

        $valor = $request->input('dados')['valor'];

        switch ($request->input('dados')['tipo']) {

            case 'competencias':

                $resultado_previo = DB::table('competencias')->select('id', 'descricao')
                    ->where('id', '=', is_numeric($valor) ? $valor : null);

                $resultado = DB::table('competencias')->select('id', 'descricao')
                    ->where('descricao', 'ilike', "%{$valor}%")->union($resultado_previo)->get();

                break;

            case 'equipes':

                $resultado_previo = DB::table('equipes')->select('id', 'descricao')
                    ->where('id', '=', is_numeric($valor) ? $valor : null);

                $resultado = DB::table('equipes')->select('id', 'descricao')
                    ->where('descricao', 'ilike', "%{$valor}%")->union($resultado_previo)->get();

                break;

            case 'recurso-competencia':

                $valor_relacionado = $request->input('dados')['valor_relacionado'];

                $resultado_previo = DB::table('recursos')->select('recursos.id', 'recursos.nome')
                    ->leftJoin('competencia_recurso', 'recursos.id', '=', 'competencia_recurso.recurso_id')
                    ->where('recursos.id', '=', is_numeric($valor) ? $valor : null)
                    ->where('competencia_recurso.competencia_id', '=', $valor_relacionado)
                    ->where('recursos.data_fim', '>', date('Y-m-d', time()));

                $resultado = DB::table('recursos')->select('recursos.id', 'recursos.nome')
                    ->leftJoin('competencia_recurso', 'recursos.id', '=', 'competencia_recurso.recurso_id')
                    ->where('recursos.nome', 'ilike', "%{$valor}%")
                    ->where('recursos.data_fim', '>', date('Y-m-d', time()))
                    ->union($resultado_previo);

                if (!is_null($valor_relacionado)) {

                    $resultado = $resultado->where('competencia_recurso.competencia_id', '=', $valor_relacionado)->get();

                } else {

                    $resultado = $resultado->get();

                }

                break;

            default:


        }

        return response()->json([

            'resultado' => $resultado

        ]);
    }

    public function editar(Request $request)
    {
        $request->session()->forget('filhos_pivot');

        $request->session()->put('filhos_pivot', $request->input('dados'));

        return response()->json([

            'resultado' => 0

        ]);
    }

    public function incluir(Request $request)
    {
        $dados_ajax = $request->input('dados');

        $dados_novos_sessao = array();

        if ($request->session()->has('filhos')) {

            $dados_novos_sessao = $request->session()->get('filhos');

        }

        if (isset($dados_ajax['filhos_incluir'])) {

            $dados_novos_sessao[$dados_ajax['tipo']]['filhos_incluir'] = $dados_ajax['filhos_incluir'];

        }

        if (isset($dados_ajax['filhos_deletar'])) {

            $dados_novos_sessao[$dados_ajax['tipo']]['filhos_deletar'] = $dados_ajax['filhos_deletar'];

        }

        $request->session()->put('filhos', $dados_novos_sessao);

        return response()->json([

            'resultado' => 0

        ]);
    }

    public function atualizarProjetos(Request $request)
    {
        $dados = $request->input('dados');

        try {
            $resultado = DB::transaction(function () use ($dados) {

                DB::table('projeto_roadmap')->where('roadmap_id', '=', $dados['roadmap'])->delete();

                $max_id = DB::table('projeto_roadmap')->max('id');

                $max_id = is_null($max_id) ? 1 : $max_id;

                DB::update(DB::raw('ALTER SEQUENCE projeto_roadmap_id_seq RESTART WITH ' . $max_id));

                DB::table('projeto_roadmap')->insert($dados['projetos']);

            });

            return is_null($resultado) ? 0 : $resultado;

        } catch (Exception $e) {

            return 1;
        }

        return response()->json([

            'resultado' => $resultado

        ]);
    }

    public function alocarProjetos(Request $request)
    {

        $roadmap = Roadmap::find(intval($request->input('dados')['roadmap']));


        $alocar = dispatch(new alocarRoadmap($roadmap));
    }

}

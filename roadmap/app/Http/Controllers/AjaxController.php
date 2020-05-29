<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\Recurso;
use App\Roadmap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jobs\alocarRoadmap;
use Illuminate\Support\Facades\Log;

class AjaxController extends Controller
{

    public function consultar(Request $request)
    {

        $dados = $request->input('dados');

        switch ($dados['tipo_principal']['tipo']) {

            case 'competencias':

            case 'equipes':

                $coluna = 'descricao';

                $filtros_adicionais = [];

                break;

            case 'recursos':

                $coluna = 'nome';

                $filtros_adicionais = [['data_fim', '>=', date('Y-m-d', time())]];

                break;

            default:

                $coluna = 'descricao';

                $filtros_adicionais = [];

        }


        $qp_id = DB::table($dados['tipo_principal']['tipo'])->select($dados['tipo_principal']['tipo'] . '.id', $dados['tipo_principal']['tipo'] . '.' . $coluna . ' as coluna')
            ->where($dados['tipo_principal']['tipo'] . '.id', '=', is_numeric($dados['tipo_principal']['valor']) ? $dados['tipo_principal']['valor'] : null);

        $qp_desc = DB::table($dados['tipo_principal']['tipo'])->select($dados['tipo_principal']['tipo'] . '.id', $dados['tipo_principal']['tipo'] . '.' . $coluna . ' as coluna')
            ->where($dados['tipo_principal']['tipo'] . '.' . $coluna, 'ilike', "%{$dados['tipo_principal']['valor']}%");

        if (isset($dados['tipos_relacionados']) && sizeof($dados['tipos_relacionados'])) {

            foreach ($dados['tipos_relacionados'] as $tr) {

                if (strcmp($dados['tipo_principal']['tipo'], $tr['tipo']) <= 0) {

                    $tabela_r = substr($dados['tipo_principal']['tipo'], 0, -1) . "_" . substr($tr['tipo'], 0, -1);

                } else {

                    $tabela_r = substr($tr['tipo'], 0, -1) . "_" . substr($dados['tipo_principal']['tipo'], 0, -1);

                }

                $qp_id = $qp_id->leftJoin($tabela_r, $dados['tipo_principal']['tipo'] . '.id', '=', $tabela_r . '.' . substr($dados['tipo_principal']['tipo'], 0, -1) . '_id');

                $qp_desc = $qp_desc->leftJoin($tabela_r, $dados['tipo_principal']['tipo'] . '.id', '=', $tabela_r . '.' . substr($dados['tipo_principal']['tipo'], 0, -1) . '_id');

                if (!is_null($tr['valor'])) {

                    $qp_id = $qp_id->where($tabela_r . '.' . substr($tr['tipo'], 0, -1) . '_id', '=', $tr['valor']);

                    $qp_desc = $qp_desc->where($tabela_r . '.' . substr($tr['tipo'], 0, -1) . '_id', '=', $tr['valor']);

                }
            }
        }

        if (isset($filtros_adicionais) && sizeof($filtros_adicionais)) {

            foreach ($filtros_adicionais as $f) {

                $qp_id = $qp_id->where($f[0], $f[1], $f[2]);

                $qp_desc = $qp_desc->where($f[0], $f[1], $f[2]);

            }

        }

        $resultado = $qp_desc->union($qp_id)->get();

        return response()->json([

            'resultado' => $resultado

        ]);

        $request->session()->forget('dados');
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

        $request->session()->forget('dados');

        return response()->json([

            'resultado' => $resultado

        ]);
    }

    public function alocarProjetos(Request $request)
    {

        $roadmap = Roadmap::find(intval($request->input('dados')['roadmap']));


        $alocar = dispatch(new alocarRoadmap($roadmap));

        $request->session()->forget('dados');

    }

    function calcularDatas(Request $request)
    {

        $dados = $request->input('dados');

        $data_base = date('Y-m-d', time());

        $roadmap = Roadmap::find(DB::raw("(select max(roadmap_id) from alocacoes)"));

        $atividade = Atividade::find($dados['atividade_id']);

        $atividade->data_inicio_real = $dados['data_inicio'];

        $atividade->percentual_real = $dados['percentual'];

        $recurso = Recurso::find($dados['recurso_id']);

        $resultado['data'] = date('d/m/Y', strtotime($atividade->calcularDataFimPorPercentual($roadmap, $recurso, $data_base)));

        $resultado['id'] = $dados['atividade_id'];


        return response()->json([

            'resultado' => $resultado

        ]);


    }

    function calcularPercentual(Request $request)
    {

        $dados = $request->input('dados');

        $roadmap = Roadmap::find(DB::raw("(select max(roadmap_id) from alocacoes)"));

        $data_base = date('Y-m-d', time());

        $atividade = Atividade::find($dados['atividade_id']);

        $data_inicio = $dados['data_inicio'];

        $data_fim = $dados['data_fim'];

        $recurso = Recurso::find($dados['recurso_id']);

        $resultado['percentual'] = $atividade->calcularPercentualPorDataFim($roadmap, $recurso, $data_fim, $data_inicio, $data_base);

        $resultado['id'] = $dados['atividade_id'];


        return response()->json([

            'resultado' => $resultado

        ]);


    }

}

<?php

namespace App\Http\Controllers;

use App\ExportadorExcel;
use App\Relatorio;
use App\Roadmap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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

        $request->session()->forget('filhos');

        $dados_ajax = $request->input('dados');

        $dados_novos_sessao = array();

        if (!is_null($dados_ajax)) {


            foreach ($dados_ajax as $d) {

                if (isset($d['filhos_incluir'])) {

                    $dados_novos_sessao[$d['tipo']]['filhos_incluir'] = $d['filhos_incluir'];

                }

                if (isset($d['filhos_deletar'])) {

                    $dados_novos_sessao[$d['tipo']]['filhos_deletar'] = $d['filhos_deletar'];

                }

            }

            $request->session()->put('filhos', $dados_novos_sessao);

        }

        return response()->json([

            'resultado' => 0

        ]);

    }

    function teste()
    {

        //
    }


}

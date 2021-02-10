<?php

namespace App;

use App\FuncoesApoio;
use App\Projeto;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Relatorio extends Model
{
    public static function relatorioAtrasoSintetico(Roadmap $roadmap)
    {

        $alocacoes = $roadmap->alocacoes;

        if ($alocacoes->count() == 0) {

            return false;
        }

        $prazos_fechadas = collect();

        $prazos_abertas = collect();

        $proj_prazos_fechados = collect();

        $proj_prazos_abertos = collect();

        $alocacoes->each(function ($aloc) use ($prazos_fechadas, $prazos_abertas) {

            $p = $aloc->atividade->prazo;

            if (!is_null($aloc->atividade->data_inicio_real) && !is_null($aloc->atividade->data_fim_real)) {

                $dadose = FuncoesData::calcularDias($aloc->atividade->data_inicio_real, $aloc->atividade->data_fim_real);

                $prazos_fechadas->push(['projeto' => $aloc->atividade->projeto_id, 'atividade' => $aloc->atividade->id, 'prazo' => $p, 'dias' => $dadose, 'atraso' => ($dadose - $p), 'atraso_perc' => ($dadose - $p) * 100 / $p]);

            } elseif (!is_null($aloc->atividade->data_inicio_real) && is_null($aloc->atividade->data_fim_real)) {

                $dadose = FuncoesData::calcularDias($aloc->atividade->data_inicio_real, date('Y-m-d', time()));

                $prazos_abertas->push(['projeto' => $aloc->atividade->projeto_id, 'atividade' => $aloc->atividade->id, 'prazo' => $p, 'dias' => $dadose, 'atraso' => ($dadose - $p), 'atraso_perc' => ($dadose - $p) * 100 / $p]);

            }

        });


        $prazos_abertas->merge($prazos_fechadas)->groupBy('projeto')->each(function ($a) use (&$proj_prazos_fechados, $proj_prazos_abertos) {

            $projeto = $a->first()['projeto'];

            $prazo = $a->sum('prazo');

            $dias = $a->sum('dias');

            $atraso = $dias - $prazo;

            $atraso_perc = $atraso * 100 / $prazo;

            if (Projeto::find($projeto)->status == 3) {

                $proj_prazos_fechados->push(['projeto' => $projeto, 'prazo' => $prazo, 'dias' => $dias, 'atraso' => $atraso, 'atraso_perc' => $atraso_perc]);

            } else {

                $proj_prazos_abertos->push(['projeto' => $projeto, 'prazo' => $prazo, 'dias' => $dias, 'atraso' => $atraso, 'atraso_perc' => $atraso_perc]);

            }

        });

        return [
            'projetos' => [
                'abertos' => $proj_prazos_abertos->toArray(),
                'fechados' => $proj_prazos_fechados->toArray()
            ],
            'atividades' => [
                'abertas' => $prazos_abertas->toArray(),
                'fechadas' => $prazos_fechadas->toArray()
            ]
        ];

    }

    public static function relatorioAtrasoAnalitico(Roadmap $roadmap)
    {
        $r = self::relatorioAtrasoSintetico($roadmap);

        $prazos_fechadas = collect($r['atividades']['fechadas']);

        $prazos_abertas = collect($r['atividades']['abertas']);

        $p_prazos_fechadas = collect($r['projetos']['fechados']);

        $p_prazos_abertas = collect($r['projetos']['abertos']);


        $dias_totais_executados_fechadas = $prazos_fechadas->sum('dias');

        $dias_totais_previstos_fechadas = $prazos_fechadas->sum('prazo');

        $dias_totais_executados_abertas = $prazos_abertas->sum('dias');

        $dias_totais_previstos_abertas = $prazos_abertas->sum('prazo');

        $dias_totais_atraso_fechadas = $dias_totais_executados_fechadas - $dias_totais_previstos_fechadas;

        $dias_totais_atraso_abertas = $dias_totais_executados_abertas - $dias_totais_previstos_abertas;

        $atraso_medio_fechadas = $prazos_fechadas->average('atraso');

        $atraso_mediano_fechadas = $prazos_fechadas->median('atraso');

        $atraso_medio_abertas = $prazos_abertas->average('atraso');

        $atraso_mediano_abertas = $prazos_abertas->median('atraso');

        $atraso_perc_medio_fechadas = $prazos_fechadas->average('atraso_perc');

        $atraso_perc_mediano_fechadas = $prazos_fechadas->median('atraso_perc');

        $atraso_perc_medio_abertas = $prazos_abertas->average('atraso_perc');

        $atraso_perc_mediano_abertas = $prazos_abertas->median('atraso_perc');

        $atraso_dp_fechadas = FuncoesApoio::calcularDesvioPadrao($prazos_fechadas->pluck('atraso')->toArray());

        $atraso_perc_dp_fechadas = FuncoesApoio::calcularDesvioPadrao($prazos_fechadas->pluck('atraso_perc')->toArray());

        $atraso_dp_abertas = FuncoesApoio::calcularDesvioPadrao($prazos_abertas->pluck('atraso')->toArray());

        $atraso_perc_dp_abertas = FuncoesApoio::calcularDesvioPadrao($prazos_abertas->pluck('atraso_perc')->toArray());


        $p_atraso_medio_fechadas = $p_prazos_fechadas->average('atraso');

        $p_atraso_mediano_fechadas = $p_prazos_fechadas->median('atraso');

        $p_atraso_medio_abertas = $p_prazos_abertas->average('atraso');

        $p_atraso_mediano_abertas = $p_prazos_abertas->median('atraso');

        $p_atraso_perc_medio_fechadas = $p_prazos_fechadas->average('atraso_perc');

        $p_atraso_perc_mediano_fechadas = $p_prazos_fechadas->median('atraso_perc');

        $p_atraso_perc_medio_abertas = $p_prazos_abertas->average('atraso_perc');

        $p_atraso_perc_mediano_abertas = $p_prazos_abertas->median('atraso_perc');

        $p_atraso_dp_fechadas = $p_prazos_fechadas->count() > 0 ? FuncoesApoio::calcularDesvioPadrao($p_prazos_fechadas->pluck('atraso')->toArray()) : null;

        $p_atraso_perc_dp_fechadas = $p_prazos_fechadas->count() > 0 ? FuncoesApoio::calcularDesvioPadrao($p_prazos_fechadas->pluck('atraso_perc')->toArray()) : null;

        $p_atraso_dp_abertas = $p_prazos_abertas->count() > 0 ? FuncoesApoio::calcularDesvioPadrao($p_prazos_abertas->pluck('atraso')->toArray()) : null;

        $p_atraso_perc_dp_abertas = $p_prazos_abertas->count() > 0 ? FuncoesApoio::calcularDesvioPadrao($p_prazos_abertas->pluck('atraso_perc')->toArray()) : null;

        return [
            'projetos' => [
                'abertos' => [
                    'dias_previstos' => $dias_totais_previstos_abertas,
                    'dias_executados' => $dias_totais_executados_abertas,
                    'dias_atraso' => $dias_totais_atraso_abertas,
                    'atraso_medio' => $p_atraso_medio_abertas,
                    'atraso_mediano' => $p_atraso_mediano_abertas,
                    'atraso_perc_medio' => $p_atraso_perc_medio_abertas,
                    'atraso_perc_mediano' => $p_atraso_mediano_abertas,
                    'atraso_dp' => $p_atraso_dp_abertas,
                    'atraso_perc_dp' => $p_atraso_perc_dp_abertas,
                    'dados' => $p_prazos_abertas->toArray()
                ],
                'fechados' => [
                    'dias_previstos' => $dias_totais_previstos_fechadas,
                    'dias_executados' => $dias_totais_executados_fechadas,
                    'dias_atraso' => $dias_totais_atraso_fechadas,
                    'atraso_medio' => $p_atraso_medio_fechadas,
                    'atraso_mediano' => $p_atraso_mediano_fechadas,
                    'atraso_perc_medio' => $p_atraso_perc_medio_fechadas,
                    'atraso_perc_mediano' => $p_atraso_mediano_fechadas,
                    'atraso_dp' => $p_atraso_dp_fechadas,
                    'atraso_perc_dp' => $p_atraso_perc_dp_fechadas,
                    'dados' => $p_prazos_fechadas->toArray()
                ]
            ],
            'atividades' => [
                'abertas' => [
                    'dias_previstos' => $dias_totais_previstos_abertas,
                    'dias_executados' => $dias_totais_executados_abertas,
                    'dias_atraso' => $dias_totais_atraso_abertas,
                    'atraso_medio' => $atraso_medio_abertas,
                    'atraso_mediano' => $atraso_mediano_abertas,
                    'atraso_perc_medio' => $atraso_perc_medio_abertas,
                    'atraso_perc_mediano' => $atraso_mediano_abertas,
                    'atraso_dp' => $atraso_dp_abertas,
                    'atraso_perc_dp' => $atraso_perc_dp_abertas,
                    'dados' => $prazos_abertas->toArray()
                ],
                'fechadas' => [
                    'dias_previstos' => $dias_totais_previstos_fechadas,
                    'dias_executados' => $dias_totais_executados_fechadas,
                    'dias_atraso' => $dias_totais_atraso_fechadas,
                    'atraso_medio' => $atraso_medio_fechadas,
                    'atraso_mediano' => $atraso_mediano_fechadas,
                    'atraso_perc_medio' => $atraso_perc_medio_fechadas,
                    'atraso_perc_mediano' => $atraso_mediano_fechadas,
                    'atraso_dp' => $atraso_dp_fechadas,
                    'atraso_perc_dp' => $atraso_perc_dp_fechadas,
                    'dados' => $prazos_fechadas->toArray()
                ]
            ]
        ];

    }

    /**
     * @param $roadmap
     * @param $tipo_dado : 0 - atividades fechadas, 1 - atividades abertas, 2 - projetos fechados, 3 - projetos abertos
     * @param int $percentual
     * @param int $faixas
     * @param int $normalizado
     * @param int $outliers
     * @return array
     * @throws Exception
     */
    public static function histogramaAtraso($roadmap, int $tipo_dado, $percentual = 1, $normalizado = 1, $outliers = 3, $faixas = 10)
    {
        $r = self::relatorioAtrasoAnalitico($roadmap);

        switch ($tipo_dado) {

            case 0:

                $ret = $r['atividades']['fechadas'];

                break;

            case 1:

                $ret = $r['atividades']['abertas'];

                break;

            case 2:

                $ret = $r['projetos']['fechados'];

                break;

            case 3:

                $ret = $r['projetos']['abertos'];

                break;

            default:

                throw new Exception('Não é um tipo de dado válido.');

        }

        $dados = collect();

        if (sizeof($ret['dados']) == 0) {

            return $dados;

        }

        for ($i = 0; $i < sizeof($ret['dados']); $i++) {

            $ret['dados'][$i]['atraso_normalizado'] = ($ret['dados'][$i]['atraso'] - ($normalizado ? $ret['atraso_medio'] : 0)) / ($normalizado ? $ret['atraso_dp'] : 1);

            $ret['dados'][$i]['atraso_perc_normalizado'] = ($ret['dados'][$i]['atraso_perc'] - ($normalizado ? $ret['atraso_perc_medio'] : 0)) / ($normalizado ? $ret['atraso_perc_dp'] : 1);

            $dados->push($ret['dados'][$i]);

        }

        if (!is_null($outliers) && $outliers) {

            $dados = $dados->filter(function ($p) use ($outliers, $percentual, $ret) {

                if ($percentual) {

                    return ($p['atraso_perc'] >= $ret['atraso_perc_medio'] - $outliers * $ret['atraso_perc_dp'] && $p['atraso_perc'] <= $ret['atraso_perc_medio'] + $outliers * $ret['atraso_perc_dp']);

                } else {

                    return ($p['atraso'] >= $ret['atraso_medio'] - $outliers * $ret['atraso_dp'] && $p['atraso'] <= $ret['atraso_medio'] + $outliers * $ret['atraso_dp']);

                }

            });

        }

        if ($percentual) {

            $min = $dados->min('atraso_perc_normalizado');

            $max = $dados->max('atraso_perc_normalizado');

            $intervalo = ($max - $min) / ($faixas - 1);

            $valores = array();

            for ($i = 0; $i < $faixas; $i++) {

                if ($i) {

                    $valores[$i]['inicial'] = $valores[$i - 1]['inicial'] + $intervalo;

                } else {

                    $valores[$i]['inicial'] = $min;

                }

                $valores[$i]['final'] = $valores[$i]['inicial'] + $intervalo;

                $frequencia = $dados->filter(function ($p) use ($i, $faixas, $valores) {

                    if ($i == $faixas - 1) {

                        return ($p['atraso_perc_normalizado'] >= $valores[$i]['inicial'] && $p['atraso_perc_normalizado'] <= $valores[$i]['final']);

                    } else {

                        return ($p['atraso_perc_normalizado'] >= $valores[$i]['inicial'] && $p['atraso_perc_normalizado'] < $valores[$i]['final']);

                    }

                })->count();

                $valores[$i]['frequencia'] = $frequencia;

            }

        } else {

            $min = $dados->min('atraso_normalizado');

            $max = $dados->max('atraso_normalizado');

            $intervalo = ($max - $min) / ($faixas - 1);

            $valores = array();

            for ($i = 0; $i < $faixas; $i++) {

                if ($i) {

                    $valores[$i]['inicial'] = $valores[$i - 1]['inicial'] + $intervalo;

                } else {

                    $valores[$i]['inicial'] = $min;

                }

                $valores[$i]['final'] = $valores[$i]['inicial'] + $intervalo;

                $frequencia = $dados->filter(function ($p) use ($i, $faixas, $valores) {

                    if ($i == $faixas - 1) {

                        return ($p['atraso_normalizado'] >= $valores[$i]['inicial'] && $p['atraso_normalizado'] <= $valores[$i]['final']);

                    } else {

                        return ($p['atraso_normalizado'] >= $valores[$i]['inicial'] && $p['atraso_normalizado'] < $valores[$i]['final']);

                    }

                })->count();

                $valores[$i]['frequencia'] = $frequencia;

            }
        }

        return $valores;

    }

    /**
     * @param Roadmap $roadmap
     * @param $tipo_dado
     * @param $n
     * @param $percentual
     * @return array
     * @throws Exception
     */
    public static function tabelaAtraso(Roadmap $roadmap, $tipo_dado, $percentual, $n = 10)
    {
        $r = self::relatorioAtrasoAnalitico($roadmap);

        switch ($tipo_dado) {

            case 0:

                $ret = $r['projetos']['fechados'];

                break;

            case 1:

                $ret = $r['projetos']['abertos'];

                break;

            default:

                throw new Exception('Não é um tipo de dado válido.');

        }

        $dados = collect($ret['dados']);

        if (sizeof($ret['dados']) == 0) {

            return $dados;

        }

        if ($percentual) {

            $dados = $dados->sortByDesc('atraso_perc')->take($n);

        } else {

            $dados = $dados->sortByDesc('atraso')->take($n);

        }

        $projetos = collect();

        foreach ($dados as $dado) {

            $projeto = json_decode(json_encode(DB::table('projetos')
                ->select('projetos.descricao as projeto', 'equipes.descricao as equipe')
                ->leftJoin('equipes', 'projetos.equipe_id', '=', 'equipes.id')
                ->where('projetos.id', '=', $dado['projeto'])
                ->first()), true);

            $projeto['atraso'] = $dado['atraso'];

            $projeto['atraso_perc'] = $dado['atraso_perc'];

            $projetos->push($projeto);

        }

        return $projetos->toArray();

    }

}

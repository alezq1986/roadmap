<?php

namespace App;

use App\FuncoesApoio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Relatorio extends Model
{
    public static function relatorioAtrasoSintetico(Roadmap $roadmap)
    {

        $alocacoes = $roadmap->alocacoes;

        $prazos_fechadas = collect();

        $prazos_abertas = collect();

        $p_prazos_fechadas = collect();

        $p_prazos_abertas = collect();

        $alocacoes->each(function ($aloc) use ($prazos_fechadas, $prazos_abertas) {

            $p = $aloc->atividade->prazo;

            if (!is_null($aloc->atividade->data_inicio_real) && !is_null($aloc->atividade->data_fim_real)) {

                $de = FuncoesData::calcularDias($aloc->atividade->data_inicio_real, $aloc->atividade->data_fim_real);

                $prazos_fechadas->push(['projeto' => $aloc->atividade->projeto_id, 'atividade' => $aloc->atividade->id, 'prazo' => $p, 'dias' => $de, 'atraso' => ($de - $p), 'atraso_perc' => ($de - $p) * 100 / $p]);

            } elseif (!is_null($aloc->atividade->data_inicio_real) && is_null($aloc->atividade->data_fim_real)) {

                $de = FuncoesData::calcularDias($aloc->atividade->data_inicio_real, date('Y-m-d', time()));

                $prazos_abertas->push(['projeto' => $aloc->atividade->projeto_id, 'atividade' => $aloc->atividade->id, 'prazo' => $p, 'dias' => $de, 'atraso' => ($de - $p), 'atraso_perc' => ($de - $p) * 100 / $p]);

            }

        });

        $prazos_abertas->groupBy('projeto')->each(function ($a) use (&$p_prazos_abertas) {

            $projeto = $a->first()['projeto'];

            $prazo = $a->sum('prazo');

            $dias = $a->sum('dias');

            $atraso = $dias - $prazo;

            $atraso_perc = $atraso * 100 / $prazo;

            $p_prazos_abertas->push(['projeto' => $projeto, 'prazo' => $prazo, 'dias' => $dias, 'atraso' => $atraso, 'atraso_perc' => $atraso_perc]);

        });

        $prazos_fechadas->groupBy('projeto')->each(function ($a) use (&$p_prazos_fechadas) {

            $projeto = $a->first()['projeto'];

            $prazo = $a->sum('prazo');

            $dias = $a->sum('dias');

            $atraso = $dias - $prazo;

            $atraso_perc = $atraso * 100 / $prazo;

            $p_prazos_fechadas->push(['projeto' => $projeto, 'prazo' => $prazo, 'dias' => $dias, 'atraso' => $atraso, 'atraso_perc' => $atraso_perc]);

        });

        return [
            'projetos' => [
                'abertos' => $p_prazos_abertas->toArray(),
                'fechados' => $p_prazos_fechadas->toArray()
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

        $p_atraso_dp_fechadas = FuncoesApoio::calcularDesvioPadrao($p_prazos_fechadas->pluck('atraso')->toArray());

        $p_atraso_perc_dp_fechadas = FuncoesApoio::calcularDesvioPadrao($p_prazos_fechadas->pluck('atraso_perc')->toArray());

        $p_atraso_dp_abertas = FuncoesApoio::calcularDesvioPadrao($p_prazos_abertas->pluck('atraso')->toArray());

        $p_atraso_perc_dp_abertas = FuncoesApoio::calcularDesvioPadrao($p_prazos_abertas->pluck('atraso_perc')->toArray());

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
                    'atraso_perc_dp' => $p_atraso_perc_dp_abertas
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
                    'atraso_perc_dp' => $p_atraso_perc_dp_fechadas
                ],
                'dados_abertos' => $p_prazos_abertas->toArray(),
                'dados_fechados' => $p_prazos_fechadas->toArray()
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
                    'atraso_perc_dp' => $atraso_perc_dp_abertas
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
                    'atraso_perc_dp' => $atraso_perc_dp_fechadas
                ],
                'dados_abertas' => $prazos_abertas->toArray(),
                'dados_fechadas' => $prazos_fechadas->toArray()
            ]
        ];

    }

    public static function histogramaAtrasos($roadmap, $percentual = 1, $faixas = 10, $normalizado = 1, $outliers = 1)
    {
        $r = self::relatorioAtrasoAnalitico($roadmap);

        $prazos_fechadas = collect();

        $prazos_abertas = collect();

        $p_prazos_fechadas = collect();

        $p_prazos_abertas = collect();


        for ($i = 0; $i < sizeof($r['atividades']['dados_fechadas']); $i++) {

            $r['atividades']['dados_fechadas'][$i]['atraso_normalizado'] = $r['atividades']['dados_fechadas'][$i]['atraso'] / $r['atividades']['fechadas']['atraso_dp'];

            $r['atividades']['dados_fechadas'][$i]['atraso_perc_normalizado'] = $r['atividades']['dados_fechadas'][$i]['atraso_perc'] / $r['atividades']['fechadas']['atraso_perc_dp'];

            $prazos_fechadas->push($r['atividades']['dados_fechadas'][$i]);

        }


        for ($i = 0; $i < sizeof($r['atividades']['dados_abertas']); $i++) {

            $r['atividades']['dados_abertas'][$i]['atraso_normalizado'] = $r['atividades']['dados_abertas'][$i]['atraso'] / $r['atividades']['abertas']['atraso_dp'];

            $r['atividades']['dados_abertas'][$i]['atraso_perc_normalizado'] = $r['atividades']['dados_abertas'][$i]['atraso_perc'] / $r['atividades']['abertas']['atraso_perc_dp'];

            $prazos_abertas->push($r['atividades']['dados_abertas'][$i]);

        }

        for ($i = 0; $i < sizeof($r['projetos']['dados_fechados']); $i++) {

            $r['projetos']['dados_fechados'][$i]['atraso_normalizado'] = $r['projetos']['dados_fechados'][$i]['atraso'] / $r['projetos']['fechados']['atraso_dp'];

            $r['projetos']['dados_fechados'][$i]['atraso_perc_normalizado'] = $r['projetos']['dados_fechados'][$i]['atraso_perc'] / $r['projetos']['fechados']['atraso_perc_dp'];

            $prazos_fechadas->push($r['projetos']['dados_fechados'][$i]);

        }

        for ($i = 0; $i < sizeof($r['projetos']['dados_abertos']); $i++) {

            $r['projetos']['dados_abertos'][$i]['atraso_normalizado'] = $r['projetos']['dados_abertos'][$i]['atraso'] / $r['projetos']['abertos']['atraso_dp'];

            $r['projetos']['dados_abertos'][$i]['atraso_perc_normalizado'] = $r['projetos']['dados_abertos'][$i]['atraso_perc'] / $r['projetos']['abertos']['atraso_perc_dp'];

            $prazos_abertas->push($r['projetos']['dados_abertos'][$i]);

        }

        if (!is_null($outliers) && $outliers) {

            $prazos_abertas = $prazos_abertas->filter(function ($p) use ($outliers, $percentual) {

                if ($percentual) {

                    return ($p['atraso_perc'] >= $p['atraso_perc_medio'] - $outliers * $p['atraso_perc_dp'] && $p['atraso_perc'] <= $p['atraso_perc_medio'] + $outliers * $p['atraso_perc_dp']);

                } else {

                    return ($p['atraso'] >= $p['atraso_medio'] - $outliers * $p['atraso_dp'] && $p['atraso'] <= $p['atraso_medio'] + $outliers * $p['atraso_dp']);

                }

            });


        }

        //histograma de atraso de atividades fechadas
        $min_atraso_fechadas = $prazos_fechadas->min('atraso_normalizado');

        $max_atraso_fechadas = $prazos_fechadas->max('atraso_normalizado');

        $intervalo_fechadas = ($max_atraso_fechadas - $min_atraso_fechadas) / ($faixas - 1);

        $valores_intervalos_fechadas = array();

        for ($i = 0; $i < $faixas; $i++) {

            if ($i) {

                $valores_intervalos_fechadas[$i]['inicial'] = $valores_intervalos_fechadas[$i - 1]['inicial'] + $intervalo_fechadas;

            } else {

                $valores_intervalos_fechadas[$i]['inicial'] = $min_atraso_fechadas;

            }

            $valores_intervalos_fechadas[$i]['final'] = $valores_intervalos_fechadas[$i]['inicial'] + $intervalo_fechadas;

            $frequencia = $prazos_fechadas->filter(function ($p) use ($i, $faixas, $valores_intervalos_fechadas) {

                if ($i == $faixas - 1) {

                    return ($p['atraso_normalizado'] >= $valores_intervalos_fechadas[$i]['inicial'] && $p['atraso_normalizado'] <= $valores_intervalos_fechadas[$i]['final']);

                } else {

                    return ($p['atraso_normalizado'] >= $valores_intervalos_fechadas[$i]['inicial'] && $p['atraso_normalizado'] < $valores_intervalos_fechadas[$i]['final']);

                }

            })->count();

            $valores_intervalos_fechadas[$i]['frequencia'] = $frequencia;

        }


        return $valores_intervalos_fechadas;

    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Relatorio extends Model
{
    public static function relatorioAtrasoSimples(Roadmap $roadmap)
    {

        $alocacoes = $roadmap->alocacoes;

        $atividades_atrasadas = collect();

        $alocacoes->each(function ($aloc) use ($atividades_atrasadas) {

            if (strtotime($aloc->data_fim_proj) <= time()) {

                $atividades_atrasadas->push($aloc);

            }

        });

        $qtd_atividades_totais = $alocacoes->count();

        $qtd_atividades_atrasadas = $atividades_atrasadas->count();

        $qtd_projetos_totais = $alocacoes->groupBy(function ($aloc, $key) {

            return $aloc->atividade->projeto->id;

        })->count();

        $qtd_projetos_atrasados = $atividades_atrasadas->groupBy(function ($aloc, $key) {

            return $aloc->atividade->projeto->id;

        })->count();

    }

    public static function relatorioAtrasoAnalitico(Roadmap $roadmap)
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

        $p_atraso_medio_fechadas = $p_prazos_fechadas->average('atraso');

        $p_atraso_mediano_fechadas = $p_prazos_fechadas->median('atraso');

        $p_atraso_medio_abertas = $p_prazos_abertas->average('atraso');

        $p_atraso_mediano_abertas = $p_prazos_abertas->median('atraso');

        $p_atraso_perc_medio_fechadas = $p_prazos_fechadas->average('atraso_perc');

        $p_atraso_perc_mediano_fechadas = $p_prazos_fechadas->median('atraso_perc');

        $p_atraso_perc_medio_abertas = $p_prazos_abertas->average('atraso_perc');

        $p_atraso_perc_mediano_abertas = $p_prazos_abertas->median('atraso_perc');


        return [
            'projetos' => [
                'abertos' => [
                    'dias_previstos' => $dias_totais_previstos_abertas,
                    'dias_executados' => $dias_totais_executados_abertas,
                    'dias_atraso' => $dias_totais_atraso_abertas,
                    'atraso_medio' => $p_atraso_medio_abertas,
                    'atraso_mediano' => $p_atraso_mediano_abertas,
                    'atraso_perc_medio' => $p_atraso_perc_medio_abertas,
                    'atraso_perc_mediano' => $p_atraso_mediano_abertas
                ],
                'fechados' => [
                    'dias_previstos' => $dias_totais_previstos_fechadas,
                    'dias_executados' => $dias_totais_executados_fechadas,
                    'dias_atraso' => $dias_totais_atraso_fechadas,
                    'atraso_medio' => $p_atraso_medio_fechadas,
                    'atraso_mediano' => $p_atraso_mediano_fechadas,
                    'atraso_perc_medio' => $p_atraso_perc_medio_fechadas,
                    'atraso_perc_mediano' => $p_atraso_mediano_fechadas
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
                    'atraso_perc_mediano' => $atraso_mediano_abertas
                ],
                'fechadas' => [
                    'dias_previstos' => $dias_totais_previstos_fechadas,
                    'dias_executados' => $dias_totais_executados_fechadas,
                    'dias_atraso' => $dias_totais_atraso_fechadas,
                    'atraso_medio' => $atraso_medio_fechadas,
                    'atraso_mediano' => $atraso_mediano_fechadas,
                    'atraso_perc_medio' => $atraso_perc_medio_fechadas,
                    'atraso_perc_mediano' => $atraso_mediano_fechadas
                ]
            ]
        ];

    }

}

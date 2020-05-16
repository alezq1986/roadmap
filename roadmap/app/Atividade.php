<?php

namespace App;

use App\Projeto;
use App\Competencia;
use App\Alocacao;
use App\Roadmap;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Atividade extends Model
{
    protected $fillable =
        ['atividade_codigo', 'projeto_id',
            'descricao', 'competencia_id',
            'prazo', 'data_inicio_real',
            'data_fim_real', 'recurso_id',
            'percentual_real'
        ];

    public function projeto()
    {
        return $this->belongsTo('App\Projeto');
    }

    public function competencia()
    {
        return $this->belongsTo('App\Competencia');
    }

    public function roadmaps()
    {
        return $this->belongsToMany('App\Roadmap');
    }

    public function alocacoes()
    {
        return $this->hasMany('App\Alocacao');
    }

    public function depende_para()
    {
        return $this->belongsToMany('App\Atividade', 'atividade_dependencia', 'dependencia_id', 'atividade_id');
    }

    public function depende_de()
    {
        return $this->belongsToMany('App\Atividade', 'atividade_dependencia', 'atividade_id', 'dependencia_id');
    }


    /**
     * @param \App\Roadmap $roadmap
     * @return array
     */
    public function calcularMelhorRecurso(Roadmap $roadmap)
    {

        $recursos = $this->competencia->recursos;

        $primeiro_recurso = null;

        $primeira_data = null;

        foreach ($recursos as $recurso) {

            $primeira_data_recurso = $recurso->calcularPrimeiraData($this, $roadmap);

            if (!isset($primeira_data)) {

                $primeira_data = $primeira_data_recurso;

                $primeiro_recurso = $recurso;

            } else {

                if ($primeira_data_recurso < $primeira_data) {

                    $primeira_data = $primeira_data_recurso;

                    $primeiro_recurso = $recurso;

                }
            }

        }
        return array('recurso' => $primeiro_recurso, 'data' => $primeira_data);
    }

    /**
     * @param $percentual
     * @param int $modo : 0 - dias corridos, 1 - exclui fins de semana, 2 - exclui fins de semana e feriados
     * @param Roadmap $roadmap
     * @param Recurso $recurso
     * @param Collection $feriados
     * @return mixed
     */
    public function calcularDataFimPorPercentual($percentual, Roadmap $roadmap, Recurso $recurso, $modo = 2, Collection $feriados = null)
    {

        if (is_null($feriados)) {

            $municipio_padrao = Parametro::where('codigo', '=', 1)->first();

            $municipio = Municipio::find($municipio_padrao->valor);

            $feriados = Feriado::feriadosPorLocal($municipio);
        }

        $prioridade = DB::table('projeto_roadmap')->select('prioridade')->where(
            [['projeto_id', '=', $this->projeto->id], ['roadmap_id', '=', $roadmap->id]]
        )->first()->prioridade;

        $datas_indisponiveis = $recurso->datasIndisponiveis($roadmap, $prioridade);

        $dias_utilizados = FuncoesData::calcularDias($this->data_inicio_real, $roadmap->data_base, $modo, 0, $datas_indisponiveis, $feriados);

        $dias_totais_necessarios = ceil($dias_utilizados / ($percentual / 100));

        $dias_remanescentes = $dias_totais_necessarios - $dias_utilizados;

        $proximo_dia_util = FuncoesData::moverDiaUtil($roadmap->data_base, 1, $feriados);

        $data_fim = FuncoesData::calcularDataFim($proximo_dia_util, $dias_remanescentes, $datas_indisponiveis, $feriados);

        return $data_fim;
    }

    public function calcularPercentualPorDataFim($data_fim, $modo, Roadmap $roadmap, Recurso $recurso, Collection $feriados)
    {

        if (is_null($feriados)) {

            $municipio_padrao = Parametro::where('codigo', '=', 1)->first();

            $municipio = Municipio::find($municipio_padrao->valor);

            $feriados = Feriado::feriadosPorLocal($municipio);
        }

        $prioridade = DB::table('projeto_roadmap')->select('prioridade')->where(
            [['projeto_id', '=', $this->projeto->id], ['roadmap_id', '=', $roadmap->id]]
        )->first()->prioridade;

        $datas_indisponiveis = $recurso->datasIndisponiveis($roadmap, $prioridade);

        $dias_utilizados = FuncoesData::calcularDias($this->data_inicio_real, $roadmap->data_base, $modo, 0, $datas_indisponiveis, $feriados);

        $dias_totais_necessarios = FuncoesData::calcularDias($this->data_inicio_real, $data_fim, $modo, 0, $datas_indisponiveis, $feriados);

        $percentual = number_format($dias_utilizados * 100 / $dias_totais_necessarios, 2, '.', ',');

        return $percentual;

    }

}

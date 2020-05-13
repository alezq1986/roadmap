<?php

namespace App;

use App\Bloqueio;
use App\Competencia;
use App\Equipe;
use App\Alocacao;
use App\Roadmap;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $fillable = ['nome', 'data_inicio', 'data_fim'];

    public function competencias()
    {
        return $this->belongsToMany('App\Competencia')->orderBy('id', 'ASC');
    }

    public function equipes()
    {
        return $this->belongsToMany('App\Equipe');
    }

    public function bloqueios()
    {
        return $this->hasMany('App\Bloqueio');
    }

    public function alocacoes()
    {
        return $this->hasMany('App\Alocacao');
    }

    public function alocacoesRoadmap(Roadmap $roadmap)
    {
        return $this->alocacoes->where('roadmap_id', '=', $roadmap->id);
    }

    /**
     * @param \App\Roadmap $roadmap
     * @param null $prioridade
     * @return \Illuminate\Support\Collection
     */
    public function datasIndisponiveis(Roadmap $roadmap, $prioridade = null)
    {
        $datas_indisponiveis = collect();

        $bloqueios = $this->bloqueios;

        $alocacoes = $this->alocacoesRoadmap($roadmap);

        if (!is_null($prioridade)) {
            $alocacoes = $alocacoes->filter(function ($alocacao) use ($prioridade) {

                return $alocacao->atividade->projeto->prioridade < $prioridade;

            });
        }

        foreach ($bloqueios as $bloqueio) {
            $datas_indisponiveis->push(['data_inicio' => $bloqueio->data_inicio, 'data_fim' => $bloqueio->data_fim]);
        }

        foreach ($alocacoes as $alocacao) {
            $datas_indisponiveis->push(['data_inicio' => $alocacao->data_inicio_proj, 'data_fim' => $alocacao->data_fim_proj]);
        }

        $datas_indisponiveis = $datas_indisponiveis->sortBy('data_inicio')->values();

        return $datas_indisponiveis;
    }


    /**
     * @param Atividade $atividade
     * @param \App\Roadmap $roadmap
     * @param Collection $feriados
     * @return mixed|null
     */
    public function calcularPrimeiraData(Atividade $atividade, Roadmap $roadmap, Collection $feriados)
    {

        $prazo = $atividade->prazo;

        $datas_indisponiveis = $this->datasIndisponiveis($roadmap, $atividade->projeto->prioridade);

        $dependencias = $atividade->depende_de;

        $ultima_data_dependencias = 0;

        foreach ($dependencias as $dependencia) {
            $data_fim_proj = $dependencia->alocacoes->where('roadmap_id', '=', $roadmap->id)->first()->data_fim_proj;

            $ultima_data_dependencias = max($ultima_data_dependencias, $data_fim_proj);

        }

        $primeira_data_apos_dependencias = FuncoesData::moverDiaUtil($ultima_data_dependencias, 1, $feriados);

        $primeira_data_apos_indisponiveis = 0;

        if ($datas_indisponiveis) {
            $ultima_data_indisponiveis = $datas_indisponiveis->max('data_fim');

            $primeira_data_apos_indisponiveis = FuncoesData::moverDiaUtil($ultima_data_indisponiveis, 1, $feriados);
        }

        $primeira_data_apos_dependencias_indisponiveis = max($primeira_data_apos_dependencias, $primeira_data_apos_indisponiveis);

        $datas_limite_recurso = array('data_inicio' => $this->data_inicio, 'data_fim' => $this->data_fim);

        if (FuncoesData::calcularDataFim($primeira_data_apos_dependencias_indisponiveis, $prazo, $datas_indisponiveis, $feriados) <= $datas_limite_recurso['data_fim']) {
            $primeira_data_recurso = $primeira_data_apos_dependencias_indisponiveis;

        } else {

            $primeira_data_recurso = null;

        }

        for ($i = 0; $i < (sizeof($datas_indisponiveis) - 1); $i++) {
            $data_inicio = max(FuncoesData::moverDiaUtil($datas_indisponiveis->get($i)['data_fim'], 1, $feriados), $datas_limite_recurso['data_inicio'], $primeira_data_apos_dependencias);

            $data_fim = min(FuncoesData::moverDiaUtil($datas_indisponiveis->get($i + 1)['data_inicio'], -1, $feriados), $datas_limite_recurso['data_fim']);

            $prazo_disponivel = FuncoesData::calcularDias($data_inicio, $data_fim, 2, 0, $di = collect(), $feriados);

            if ($prazo_disponivel >= $prazo) {

                $primeira_data_recurso = $data_inicio;

                break;

            }

        }
        return $primeira_data_recurso;
    }
}

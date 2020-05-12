<?php

namespace App;

use App\Bloqueio;
use App\Competencia;
use App\Equipe;
use App\Alocacao;
use App\Roadmap;
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

}

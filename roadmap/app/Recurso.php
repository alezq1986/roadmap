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
        $alocacoes = $this->alocacoesRoadmap($roadmap);

        $bloqueios = $this->bloqueios;


        if (!is_null($prioridade)) {
            $alocacoes = $alocacoes->filter(function ($alocacao) use ($prioridade) {

                return $alocacao->atividade->projeto->prioridade < $prioridade;

            });
        }

        $datas_indisponiveis = $alocacoes->collect($bloqueios);

        return $datas_indisponiveis;
    }

}

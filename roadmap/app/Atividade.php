<?php

namespace App;

use App\Projeto;
use App\Competencia;
use App\Alocacao;
use App\Roadmap;
use Illuminate\Database\Eloquent\Model;

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

    public function depende_de()
    {
        $this->belongsToMany('App\Atividade', 'atividade_dependencia', 'dependencia_id', 'atividade_id');
    }

    public function depende_para()
    {
        $this->belongsToMany('App\Atividade', 'atividade_dependencia', 'atividade_id', 'dependencia_id');
    }
}

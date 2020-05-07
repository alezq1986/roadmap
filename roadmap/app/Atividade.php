<?php

namespace App;

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

    public function projetos()
    {
        return $this->belongsTo('App\Projeto');
    }

    public function competencias()
    {
        return $this->belongsTo('App\Competencia');
    }

    public function roadmaps()
    {
        return $this->belongsToMany('App\Roadmap');
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

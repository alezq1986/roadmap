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

}

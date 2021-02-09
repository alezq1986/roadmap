<?php

namespace App;

use App\Recurso;
use App\Roadmap;
use App\Atividade;
use App\Projeto;
use Illuminate\Database\Eloquent\Model;

class Alocacao extends Model
{
    protected $table = 'alocacoes';

    protected $fillable = ['atividade_id', 'recurso_id',
        'data_inicio_proj', 'data_fim_proj',
        'roadmap_id'];

    public function recurso()
    {
        return $this->belongsTo('App\Recurso');
    }

    public function roadmap()
    {
        return $this->belongsTo('App\Roadmap');
    }

    public function atividade()
    {
        return $this->belongsTo('App\Atividade');
    }


}

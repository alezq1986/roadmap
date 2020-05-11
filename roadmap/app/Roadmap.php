<?php

namespace App;

use App\Atividade;
use App\Alocacao;
use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    protected $fillable = ['data_base'];

    public function atividades()
    {
        return $this->belongsToMany('App\Atividade');
    }

    public function alocacoes()
    {
        return $this->hasMany('App\Alocacao');
    }
}

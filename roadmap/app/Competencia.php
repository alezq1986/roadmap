<?php

namespace App;

use App\Recurso;
use App\Atividade;
use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    protected $fillable = ['descricao'];

    public function recursos()
    {
        return $this->belongsToMany('App\Recurso');
    }

    public function atividades()
    {
        return $this->hasMany('App\Atividade');
    }

}

<?php

namespace App;

use App\Estado;
use App\Feriado;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'paises';

    protected $fillable = ['codigo_bacen', 'descricao'];

    public function estados()
    {
        return $this->hasMany('App\Estado');
    }

    public function feriados()
    {
        return $this->morphMany('App\Feriado', 'entidade', 'entidade_tipo');
    }
}

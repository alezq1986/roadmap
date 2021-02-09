<?php

namespace App;

use App\Pais;
use App\Estado;
use App\Feriado;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    public function pais()
    {
        return $this->belongsTo('App\Pais');
    }

    public function estado()
    {
        return $this->belongsTo('App\Estado');
    }

    public function feriados()
    {
        return $this->morphMany('App\Feriado', 'entidade', 'entidade_tipo');
    }
}

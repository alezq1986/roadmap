<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    public function paises()
    {
        return $this->belongsTo('App\Pais');
    }

    public function estados()
    {
        return $this->belongsTo('App\Estado');
    }

    public function feriados()
    {
        return $this->morphMany('App\Feriado', 'entidades');
    }
}

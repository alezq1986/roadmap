<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $fillable = ['codigo_interno', 'pais_id',
        'sigla', 'descricao'];

    public function paises()
    {
        return $this->belongsTo('App\Pais');
    }

    public function municipios()
    {
        return $this->hasMany('App\Municipio');
    }

    public function feriados()
    {
        return $this->morphMany('App\Feriado', 'entidades');
    }
}

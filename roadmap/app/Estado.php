<?php

namespace App;

use App\Pais;
use App\Municipio;
use App\Feriado;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $fillable = ['codigo_interno', 'pais_id',
        'sigla', 'descricao'];

    public function pais()
    {
        return $this->belongsTo('App\Pais');
    }

    public function municipios()
    {
        return $this->hasMany('App\Municipio');
    }

    public function feriados()
    {
        return $this->morphMany('App\Feriado', 'entidade', 'entidade_tipo');
    }
}

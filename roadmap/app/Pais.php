<?php

namespace App;

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
        return $this->morphMany('App\Feriado', 'entidades');
    }
}

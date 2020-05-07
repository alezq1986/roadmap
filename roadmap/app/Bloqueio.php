<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bloqueio extends Model
{
    protected $fillable = ['recurso_id', 'data_inicio', 'data_fim'];

    public function recursos()
    {
        return $this->belongsTo('Appp\Recurso');
    }
}

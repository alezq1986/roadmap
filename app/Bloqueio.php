<?php

namespace App;

use App\Recurso;
use Illuminate\Database\Eloquent\Model;

class Bloqueio extends Model
{
    protected $fillable = ['recurso_id', 'data_inicio', 'data_fim'];

    public function recurso()
    {
        return $this->belongsTo('Appp\Recurso');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bloqueio extends Model
{
    public function recursos()
    {
        return $this->belongsTo('Appp\Recurso');
    }
}

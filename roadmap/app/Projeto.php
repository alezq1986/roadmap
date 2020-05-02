<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    public function atividades()
    {
        return $this->hasMany('App\Atividade');
    }
}

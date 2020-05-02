<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    public function atividades()
    {
        return $this->belongsToMany('App\Atividade');
    }
}

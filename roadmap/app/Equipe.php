<?php

namespace App;

use App\Recurso;
use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    public function recursos()
    {
        return $this->belongsToMany('App\Recurso');
    }

    public function projeto()
    {
        return $this->belongsTo('App\Projeto');
    }

}

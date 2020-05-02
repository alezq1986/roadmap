<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    public function recursos()
    {
        return $this->belongsToMany('App\Recurso');
    }

}

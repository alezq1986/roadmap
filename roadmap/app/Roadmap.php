<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    protected $fillable = ['data_base'];

    public function atividades()
    {
        return $this->belongsToMany('App\Atividade');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $fillable = ['descricao', 'prioridade', 'equipe_id'];

    public function atividades()
    {
        return $this->hasMany('App\Atividade');
    }
}

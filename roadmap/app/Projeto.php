<?php

namespace App;

use App\Atividade;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $fillable = ['descricao', 'prioridade', 'equipe_id'];

    public function atividades()
    {
        return $this->hasMany('App\Atividade');
    }

    public function equipe()
    {
        return $this->hasOne('App\Equipe');
    }
}

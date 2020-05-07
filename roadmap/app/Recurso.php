<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $fillable = ['nome', 'data_inicio', 'data_fim'];

    public function competencias()
    {
        return $this->belongsToMany('App\Competencia')->orderBy('id', 'ASC');
    }

    public function equipes()
    {
        return $this->belongsToMany('App\Equipe');
    }

    public function bloqueios()
    {
        return $this->hasMany('App\Bloqueio');
    }

    public function alocacoes(Roadmap $roadmap)
    {
        return DB::table('atividade_roadmap')->where(['roadmap_id', '=', $roadmap->id])->get();
    }

    public function datasIndisponiveis(Roadmap $roadmap, $prioridade = null)
    {
        $alocacoes = $this->alocacoes($roadmap);
        dd($alocacoes);
        if (!is_null($prioridade)) {
            //
        }
    }

}

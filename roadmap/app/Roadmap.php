<?php

namespace App;

use App\Atividade;
use App\Alocacao;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Roadmap extends Model
{
    protected $fillable = ['data_base'];

    public function atividades()
    {
        return $this->belongsToMany('App\Atividade');
    }

    public function alocacoes()
    {
        return $this->hasMany('App\Alocacao');
    }

    public function projetos()
    {
        return $this->belongsToMany('App\Projeto');
    }

    public static function criarRoadmap(Request $request)
    {

        DB::transaction(function () use ($request) {

            $roadmap = Roadmap::create([
                'data_base' => $request->input('data_base'),
            ]);

        });
    }

    public static function atualizarRoadmap(Request $request, Roadmap $roadmap)
    {
        DB::transaction(function () use ($request, $roadmap) {

            $roadmap->data_base = $request->input('data_base');

            $roadmap->save();

        });
    }

}

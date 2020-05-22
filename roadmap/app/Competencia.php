<?php

namespace App;

use App\Recurso;
use App\Atividade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Competencia extends Model
{
    protected $fillable = ['descricao'];

    public function recursos()
    {
        return $this->belongsToMany('App\Recurso');
    }

    public function atividades()
    {
        return $this->hasMany('App\Atividade');
    }

    public static function criarCompetencia(Request $request)
    {

        DB::transaction(function () use ($request) {

            $competencia = Competencia::create([
                'descricao' => $request->input('descricao'),
            ]);

            while ($request->session()->get('aguardar')) {

            }

            if ($request->session()->has('filhos')) {

                FuncoesFilhos::criarFilhos($request, $competencia);
            }
        });
    }

    public static function atualizarCompetencia(Request $request, Competencia $competencia)
    {
        DB::transaction(function () use ($request, $competencia) {

            $competencia->descricao = $request->input('descricao');

            $competencia->save();

            while ($request->session()->get('aguardar')) {

            }

            if ($request->session()->has('filhos')) {

                FuncoesFilhos::criarFilhos($request, $competencia);

            }
        });
    }

}

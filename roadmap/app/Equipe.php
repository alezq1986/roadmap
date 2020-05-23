<?php

namespace App;

use App\Recurso;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Equipe extends Model
{
    protected $fillable = ['descricao'];

    public function recursos()
    {
        return $this->belongsToMany('App\Recurso');
    }

    public function projeto()
    {
        return $this->belongsTo('App\Projeto');
    }

    public static function criarEquipe(Request $request)
    {

        DB::transaction(function () use ($request) {

            $equipe = Equipe::create([
                'descricao' => $request->input('descricao'),
            ]);

            if ($request->session()->has('filhos')) {

                FuncoesFilhos::criarFilhos($request, $equipe);
            }

            if ($request->session()->has('filhos_pivot')) {

                FuncoesFilhos::criarFilhosPivot($request, $equipe);
            }

        });
    }

    public static function atualizarEquipe(Request $request, Equipe $equipe)
    {
        DB::transaction(function () use ($request, $equipe) {

            $equipe->descricao = $request->input('descricao');

            $equipe->save();

            if ($request->session()->has('filhos')) {

                FuncoesFilhos::criarFilhos($request, $equipe);

            }

            if ($request->session()->has('filhos_pivot')) {

                FuncoesFilhos::criarFilhosPivot($request, $equipe);
            }

        });
    }

}

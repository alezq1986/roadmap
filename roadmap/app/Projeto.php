<?php

namespace App;

use App\Atividade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Projeto extends Model
{
    protected $fillable = ['descricao', 'equipe_id', 'status', 'status_aprovacao'];

    public function atividades()
    {
        return $this->hasMany('App\Atividade');
    }

    public function equipe()
    {
        return $this->hasOne('App\Equipe');
    }

    public function roadmaps()
    {
        return $this->belongsToMany('App\Roadmap');
    }

    public static function criarProjeto(Request $request)
    {
        try {

            $resultado = DB::transaction(function () use ($request) {

                $projeto = Projeto::create([
                    'descricao' => $request->input('descricao'),
                    'status_aprovacao' => $request->input('status_aprovacao'),
                    'equipe_id' => $request->input('equipe_id'),
                ]);


                if ($request->session()->has('filhos')) {

                    FuncoesFilhos::criarFilhos($request, $projeto);

                    Atividade::criarDependencias($projeto);
                }

                return $projeto;

            });

            return $resultado;

        } catch (Exception $e) {

            return 1;

        }
    }

    public static function atualizarProjeto(Request $request, Projeto $projeto)
    {
        try {

            $resultado = DB::transaction(function () use ($request, $projeto) {

                $projeto->descricao = $request->input('descricao');
                $projeto->equipe_id = $request->input('equipe_id');
                $projeto->status = $request->input('status');
                $projeto->status_aprovacao = $request->input('status_aprovacao');

                $projeto->save();

                if ($request->session()->has('filhos')) {

                    FuncoesFilhos::criarFilhos($request, $projeto);

                    Atividade::criarDependencias($projeto);

                }

                return $projeto;

            });

            return $resultado;

        } catch (Exception $e) {

            return 1;

        }
    }


}

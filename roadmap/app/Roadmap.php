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


    public function alocacoes()
    {
        return $this->hasMany('App\Alocacao');
    }

    public function projetos()
    {
        return $this->belongsToMany('App\Projeto')->withPivot('prioridade');
    }

    public function atividades()
    {
        $projetos = $this->projetos;

        $atividades = collect();

        foreach ($projetos as $projeto) {

            $atividades->push($projeto->atividades);

        }
        return $atividades->flatten();
    }


    public function alocar()
    {
        DB::update(DB::raw('truncate table alocacoes restart identity cascade'));

        $atividades = $this->atividades();

        foreach ($atividades as $atividade) {

            $continuar = (parse_ini_file(storage_path('alocar.ini')))['continuar'];

            if ($continuar == 1) {

                $atividade->alocarAtividade($this);
            } else {

                return 1;
            }
        }

        return 0;

    }


    public static function criarRoadmap(Request $request)
    {

        DB::transaction(function () use ($request) {

            $roadmap = Roadmap::create([
                'data_base' => $request->input('data_base'),
            ]);

            if ($request->session()->has('filhos')) {

                FuncoesFilhos::criarFilhos($request, $roadmap);

            }

            if ($request->session()->has('filhos_pivot')) {

                FuncoesFilhos::criarFilhosPivot($request, $roadmap);
            }

        });
    }

    public static function atualizarRoadmap(Request $request, Roadmap $roadmap)
    {
        DB::transaction(function () use ($request, $roadmap) {

            $roadmap->data_base = $request->input('data_base');

            $roadmap->save();

            if ($request->session()->has('filhos')) {

                FuncoesFilhos::criarFilhos($request, $roadmap);

            }

            if ($request->session()->has('filhos_pivot')) {

                FuncoesFilhos::criarFilhosPivot($request, $roadmap);
            }

        });
    }

}

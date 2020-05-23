<?php

namespace App\Http\Controllers;

use App\Roadmap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jobs\alocarRoadmap;
use Illuminate\Support\Facades\Log;

class AjaxController extends Controller
{

    public function consultar(Request $request)
    {
        $classe = 'App\\' . $request->input('dados')[0]['modelo'];

        if (is_numeric($request->input('dados')[0]['id'])) {

            $resultado = $classe::where('id', '=', $request->input('dados')[0]['id'])->get();

        } else {

            $resultado = $classe::where('descricao', 'ilike', "%{$request->input('dados')[0]['id']}%")->get();

        }

        return response()->json([

            'resultado' => $resultado

        ]);
    }

    public function editar(Request $request)
    {
        $request->session()->forget('filhos_pivot');

        $request->session()->put('filhos_pivot', $request->input('dados'));

        return response()->json([

            'resultado' => 0

        ]);
    }

    public function atualizarProjetos(Request $request)
    {
        $dados = $request->input('dados');

        try {
            $resultado = DB::transaction(function () use ($dados) {

                DB::table('projeto_roadmap')->where('roadmap_id', '=', $dados['roadmap'])->delete();

                $max_id = DB::table('projeto_roadmap')->max('id');

                $max_id = is_null($max_id) ? 1 : $max_id;

                DB::update(DB::raw('ALTER SEQUENCE projeto_roadmap_id_seq RESTART WITH ' . $max_id));

                DB::table('projeto_roadmap')->insert($dados['projetos']);

            });

            return is_null($resultado) ? 0 : $resultado;

        } catch (Exception $e) {

            return 1;
        }

        return response()->json([

            'resultado' => $resultado

        ]);
    }

    public function alocarProjetos(Request $request)
    {

        $roadmap = Roadmap::find(intval($request->input('dados')['roadmap']));


        $alocar = dispatch(new alocarRoadmap($roadmap));
    }

}

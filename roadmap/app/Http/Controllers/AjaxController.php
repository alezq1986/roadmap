<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function ajaxRequestPost(Request $request)
    {
        if ($request->input('acao') == 'consultar') {

            $classe = 'App\\' . $request->input('dados')[0]['modelo'];

            if (is_numeric($request->input('dados')[0]['id'])) {

                $resultado = $classe::where('id', '=', $request->input('dados')[0]['id'])->get();

            } else {

                $resultado = $classe::where('descricao', 'ilike', "%{$request->input('dados')[0]['id']}%")->get();

            }

            return response()->json([

                'resultado' => $resultado

            ]);

        } elseif ($request->input('acao') == 'editar') {

            $request->session()->forget('filhos');

            $request->session()->put('filhos', $request->input('dados'));

            return response()->json([

                'resultado' => 0

            ]);

            $request->session()->put('aguardar', 0);


        } elseif ($request->input('acao') == 'aguardar') {

            $request->session()->put('aguardar', 1);

            return response()->json([

                'resultado' => 0

            ]);

        } elseif ($request->input('acao') == 'atualizar-projetos') {

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
    }
}

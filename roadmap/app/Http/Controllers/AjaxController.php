<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
                'success' => $resultado
            ]);

        } elseif ($request->input('acao') == 'inserir') {
            $request->session()->forget('filhos');
            $request->session()->put('filhos', $request->input('dados'));
        }
    }
}

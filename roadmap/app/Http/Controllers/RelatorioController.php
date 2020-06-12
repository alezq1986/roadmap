<?php

namespace App\Http\Controllers;

use App\Relatorio;
use App\Roadmap;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function show()
    {

        $roadmaps = Roadmap::all();

        return view('relatorios.show', ['roadmaps' => $roadmaps]);

    }

    public function pegarDados(Request $request)
    {

        $dados_ajax = $request->get('dados');

        $tipo_dado = $dados_ajax['tipo_dado'];

        $roadmap_id = $dados_ajax['roadmap_id'];

        $percentual = $dados_ajax['percentual'];

        $normalizado = $dados_ajax['normalizado'];

        $resultado = Relatorio::histogramaAtrasos(Roadmap::find($roadmap_id), $tipo_dado, $percentual, $normalizado, null);

        return response()->json([

            'resultado' => $resultado

        ]);


    }
}

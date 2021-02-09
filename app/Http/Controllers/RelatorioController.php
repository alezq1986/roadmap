<?php

namespace App\Http\Controllers;

use App\Relatorio;
use App\Roadmap;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function dashboard()
    {

        $roadmaps = Roadmap::all();

        return view('relatorios.dashboard', ['roadmaps' => $roadmaps]);

    }

    public function histogramaAtraso(Request $request)
    {

        $dados_ajax = $request->get('dados');

        $tipo_dado = $dados_ajax['tipo_dado'];

        $roadmap_id = $dados_ajax['roadmap_id'];

        $percentual = $dados_ajax['percentual'];

        $normalizado = $dados_ajax['normalizado'];

        $resultado = Relatorio::histogramaAtraso(Roadmap::find($roadmap_id), $tipo_dado, $percentual, $normalizado, 3, 20);

        return response()->json([

            'resultado' => $resultado

        ]);

    }

    public function tabelaAtraso(Request $request)
    {

        $dados_ajax = $request->get('dados');

        $tipo_dado = $dados_ajax['tipo_dado'];

        $roadmap_id = $dados_ajax['roadmap_id'];

        $percentual = $dados_ajax['percentual'];

        $resultado = Relatorio::tabelaAtraso(Roadmap::find($roadmap_id), $tipo_dado, $percentual);

        return response()->json([

            'resultado' => $resultado

        ]);


    }
}

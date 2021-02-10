<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\Recurso;
use App\Roadmap;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AtividadeController extends Controller
{
    protected $rules = ['descricao' => 'required|string|max:100'];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param Atividade $atividade
     * @return Response
     */
    public function show(Atividade $atividade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Atividade $atividade
     * @return Response
     */
    public function edit(Atividade $atividade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Atividade $atividade
     * @return Response
     */
    public function update(Request $request, Atividade $atividade)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Atividade $atividade
     * @return Response
     */
    public function destroy(Atividade $atividade)
    {
        //
    }

    function atualizarAtividades(Request $request)
    {

        try {

            $r = Atividade::atualizarAtividades($request);

        } catch (Exception $e) {


            return false;

        }

        return $r;


    }

    function calcularDatas(Request $request)
    {

        $dados = $request->input('dados');

        $data_base = date('Y-m-d', time());

        $roadmap = Roadmap::find(DB::raw("(select max(roadmap_id) from alocacoes)"));

        $atividade = Atividade::find($dados['atividade_id']);

        $atividade->data_inicio_real = $dados['data_inicio'];

        $atividade->percentual_real = $dados['percentual'];

        $recurso = Recurso::find($dados['recurso_id']);

        $resultado['data'] = date('d/m/Y', strtotime($atividade->calcularDataFimPorPercentual($roadmap, $recurso, $data_base)));

        $resultado['id'] = $dados['atividade_id'];

        return response()->json([

            'resultado' => $resultado

        ]);


    }

    function calcularPercentual(Request $request)
    {

        $dados = $request->input('dados');

        $roadmap = Roadmap::find(DB::raw("(select max(roadmap_id) from alocacoes)"));

        $data_base = date('Y-m-d', time());

        $atividade = Atividade::find($dados['atividade_id']);

        $data_inicio = $dados['data_inicio'];

        $data_fim = $dados['data_fim'];

        $recurso = Recurso::find($dados['recurso_id']);

        $resultado['percentual'] = $atividade->calcularPercentualPorDataFim($roadmap, $recurso, $data_fim, $data_base, $data_inicio);

        $resultado['id'] = $dados['atividade_id'];

        return response()->json([

            'resultado' => $resultado

        ]);

    }

}

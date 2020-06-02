<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\Recurso;
use App\Roadmap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AtividadeController extends Controller
{
    protected $rules = ['descricao' => 'required|string|max:100'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Atividade $atividade
     * @return \Illuminate\Http\Response
     */
    public function show(Atividade $atividade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Atividade $atividade
     * @return \Illuminate\Http\Response
     */
    public function edit(Atividade $atividade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Atividade $atividade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atividade $atividade)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Atividade $atividade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atividade $atividade)
    {
        //
    }

    public function massEdit()
    {
        $atividades = DB::table('atividades')->select('atividades.projeto_id as projeto_id', 'atividades.id as id', 'atividades.competencia_id as competencia_id', 'atividades.descricao as descricao', 'atividades.data_inicio_real', 'alocacoes.data_inicio_proj', 'alocacoes.data_fim_proj',
            'atividades.percentual_real', 'projetos.descricao as projeto', 'recursos.nome as nome', 'atividades.recurso_real_id as recurso_real_id', 'projetos.equipe_id')
            ->leftJoin('projetos', 'atividades.projeto_id', '=', 'projetos.id')
            ->leftJoin('recursos', 'atividades.recurso_real_id', '=', 'recursos.id')
            ->leftJoin('alocacoes', 'atividades.id', '=', 'alocacoes.atividade_id')
            ->where('atividades.percentual_real', '<', 100)
            ->whereNotIn('projetos.status_aprovacao', [0])
            ->whereNotIn('projetos.status', [3])
            ->where('alocacoes.roadmap_id', '=', DB::raw("(select max(roadmap_id) from alocacoes)"))
            ->orderBy('projetos.id', 'ASC')
            ->orderBy('atividades.atividade_codigo', 'ASC')
            ->get();

        return view('atividades.mass-edit', ['atividades' => $atividades]);
    }


    function atualizarAtividades(Request $request)
    {

        try {

            $r = Atividade::atualizarAtividades($request);

        } catch (\Exception $e) {


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

<?php

namespace App\Http\Controllers;

use App\Equipe;
use App\Jobs\alocarRoadmap;
use App\Projeto;
use App\Atividade;
use App\Roadmap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RoadmapController extends Controller
{
    protected $rules = ['descricao' => 'required|string|max:100',
        'data_base' => 'required|date'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->all();

        $where = array();

        if (!empty($data)) {

            if ($request->has('id') && $request->get('id') != null) {
                array_push($where, ['id', '=', $request->get('id')]);
            }

            if ($request->has('data_base_de') && $request->get('data_base_de') != null) {
                array_push($where, ['data_base', '>=', $request->get('data_base_de')]);
            }

            if ($request->has('data_base_ate') && $request->get('data_base_ate') != null) {
                array_push($where, ['data_base', '<=', $request->get('data_base_ate')]);
            }

            $roadmaps = Roadmap::where($where)->orderBy('id', 'ASC')->paginate(10);

        } else {

            $roadmaps = Roadmap::orderBy('id', 'ASC')->paginate(10);
        }

        return view('roadmaps.index', ['roadmaps' => $roadmaps, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roadmaps.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->rules);

        Roadmap::criarRoadmap($request);

        return redirect('roadmaps/');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Roadmap $roadmap
     * @return \Illuminate\Http\Response
     */
    public function show(Roadmap $roadmap)
    {
        $atividades = DB::table('alocacoes')->select(
            'atividades.projeto_id', 'atividades.prazo', 'atividades.data_inicio_real', 'atividades.percentual_real',
            'competencias.descricao as competencia',
            'equipes.descricao as equipe',
            'alocacoes.data_inicio_proj', 'alocacoes.data_fim_proj',
            'recursos.nome as recurso',
            'projeto_roadmap.prioridade',
            'projetos.descricao as projeto', 'projetos.status', 'projetos.status_aprovacao')
            ->leftJoin('atividades', 'alocacoes.atividade_id', '=', 'atividades.id')
            ->leftJoin('projetos', 'atividades.projeto_id', '=', 'projetos.id')
            ->leftJoin('competencias', 'atividades.competencia_id', '=', 'competencias.id')
            ->leftJoin('equipes', 'projetos.equipe_id', '=', 'equipes.id')
            ->leftJoin('projeto_roadmap', function ($join) {
                $join->on('atividades.projeto_id', '=', 'projeto_roadmap.projeto_id')
                    ->on('alocacoes.roadmap_id', '=', 'projeto_roadmap.roadmap_id');
            })
            ->leftJoin('recursos', 'atividades.recurso_real_id', '=', 'recursos.id')
            ->where('alocacoes.roadmap_id', '=', $roadmap->id)
            ->orderBy('projeto_roadmap.prioridade', 'ASC')
            ->orderBy('atividades.atividade_codigo', 'ASC')
            ->get();

        $projetos = DB::table('atividades')->select('atividades.projeto_id', DB::raw('COUNT(atividades.projeto_id) as qtd'))
            ->leftJoin('alocacoes', 'atividades.id', '=', 'alocacoes.atividade_id')
            ->leftJoin('roadmaps', 'alocacoes.roadmap_id', '=', 'roadmaps.id')
            ->leftJoin('projetos', 'atividades.projeto_id', '=', 'projetos.id')
            ->where('alocacoes.roadmap_id', '=', $roadmap->id)
            ->groupBy('atividades.projeto_id')
            ->get();


        return view('roadmaps.show', ['roadmap' => $roadmap, 'projetos' => $projetos, 'atividades' => $atividades]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Roadmap $roadmap
     * @return \Illuminate\Http\Response
     */
    public function edit(Roadmap $roadmap)
    {
        return view('roadmaps.edit', ['roadmap' => $roadmap]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Roadmap $roadmap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Roadmap $roadmap)
    {
        $request->validate($this->rules);

        $roadmap->atualizarRoadmap($request, $roadmap);

        return redirect('roadmaps/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Roadmap $roadmap
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roadmap $roadmap)
    {
        $roadmap->destroy($roadmap->id);

        return redirect('roadmaps/');
    }

    public function configurarRoadmap($id)
    {
        $roadmap = Roadmap::find($id);

        $projetos = DB::table('projetos')
            ->select('projetos.id', 'projetos.descricao as projeto_descricao', 'projetos.status', 'projetos.status_aprovacao', 'projeto_roadmap.roadmap_id', 'projeto_roadmap.prioridade', 'equipes.descricao as equipe_descricao')
            ->leftjoin('projeto_roadmap', 'projetos.id', '=', 'projeto_roadmap.projeto_id')
            ->leftJoin('equipes', 'projetos.equipe_id', '=', 'equipes.id')
            ->whereNotIn('projetos.status', [3])
            ->whereNotIn('projetos.status_aprovacao', [0])
            ->where('projeto_roadmap.roadmap_id', '=', $id)
            ->orderByRaw('projeto_roadmap.prioridade ASC NULLS last')
            ->get();

        if ($projetos->count() == 0) {

            $max_id = DB::table('projeto_roadmap')->max('roadmap_id');


            if (!is_null($max_id)) {

                $projetos_nao_alocados = DB::table('projetos')
                    ->select('projetos.id', 'projetos.descricao as projeto_descricao', 'projetos.status', 'projetos.status_aprovacao', 'projeto_roadmap.roadmap_id', 'projeto_roadmap.prioridade', 'equipes.descricao as equipe_descricao')
                    ->leftjoin('projeto_roadmap', 'projetos.id', '=', 'projeto_roadmap.projeto_id')
                    ->leftJoin('equipes', 'projetos.equipe_id', '=', 'equipes.id')
                    ->whereNotIn('projetos.status', [3])
                    ->whereNotIn('projetos.status_aprovacao', [0])
                    ->where('projeto_roadmap.roadmap_id', '=', null);

                $projetos = DB::table('projetos')
                    ->select('projetos.id', 'projetos.descricao as projeto_descricao', 'projetos.status', 'projetos.status_aprovacao', 'projeto_roadmap.roadmap_id', 'projeto_roadmap.prioridade', 'equipes.descricao as equipe_descricao')
                    ->leftjoin('projeto_roadmap', 'projetos.id', '=', 'projeto_roadmap.projeto_id')
                    ->leftJoin('equipes', 'projetos.equipe_id', '=', 'equipes.id')
                    ->whereNotIn('projetos.status', [3])
                    ->whereNotIn('projetos.status_aprovacao', [0])
                    ->where('projeto_roadmap.roadmap_id', '=', $max_id - 1)
                    ->union($projetos_nao_alocados)
                    ->orderByRaw('projeto_roadmap.prioridade ASC NULLS last')
                    ->get();

            } else {
                $projetos = DB::table('projetos')
                    ->select('projetos.id', 'projetos.descricao as projeto_descricao', 'projetos.status', 'projetos.status_aprovacao', 'projeto_roadmap.roadmap_id', 'projeto_roadmap.prioridade', 'equipes.descricao as equipe_descricao')
                    ->leftjoin('projeto_roadmap', 'projetos.id', '=', 'projeto_roadmap.projeto_id')
                    ->leftJoin('equipes', 'projetos.equipe_id', '=', 'equipes.id')
                    ->whereNotIn('projetos.status', [3])
                    ->whereNotIn('projetos.status_aprovacao', [0])
                    ->get();

            }
        }


        $atividades = DB::table('atividades')->select('atividades.projeto_id as projeto_id', 'atividades.id as id', 'atividades.competencia_id as competencia_id', 'atividades.descricao as descricao', 'atividades.data_inicio_real', 'alocacoes.data_inicio_proj', 'alocacoes.data_fim_proj',
            'atividades.percentual_real', 'projetos.descricao as projeto', 'recursos.nome as nome', 'atividades.recurso_real_id as recurso_real_id', 'projetos.equipe_id')
            ->leftJoin('projetos', 'atividades.projeto_id', '=', 'projetos.id')
            ->leftJoin('recursos', 'atividades.recurso_real_id', '=', 'recursos.id')
            ->leftJoin('alocacoes', 'atividades.id', '=', 'alocacoes.atividade_id')
            ->where('atividades.percentual_real', '<', 100)
            ->whereNotIn('projetos.status_aprovacao', [0])
            ->whereNotIn('projetos.status', [3])
            ->orderBy('projetos.id', 'ASC')
            ->orderBy('atividades.atividade_codigo', 'ASC')
            ->get();


        return view('roadmaps.configura', ['projetos' => $projetos, 'roadmap' => $roadmap, 'atividades' => $atividades]);
    }


    public function alocarRoadmap(Request $request)
    {

        $roadmap = Roadmap::find(intval($request->input('dados')['roadmap']));

        $alocar = dispatch(new alocarRoadmap($roadmap));

        $request->session()->forget('dados');

    }

}

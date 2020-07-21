<?php

namespace App\Http\Controllers;

use App\Alocacao;
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
            'atividades.projeto_id', 'atividades.descricao', 'atividades.prazo', 'atividades.data_inicio_real', 'atividades.percentual_real',
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

        $a = DB::table('projeto_roadmap')->where('roadmap_id', '=', $id)->first();

        if (is_null($a)) {

            $max_id = DB::table('projeto_roadmap')->max('roadmap_id');

            $max_id = is_null($max_id) ? 0 : $max_id;

            $projetos = DB::select(DB::raw("select * from
((select projetos.id, projetos.descricao as projeto_descricao, projetos.status, projetos.status_aprovacao, projeto_roadmap.roadmap_id, projeto_roadmap.prioridade, equipes.descricao as equipe_descricao from projetos
left join projeto_roadmap on projetos.id = projeto_roadmap.projeto_id
left join equipes on projetos.equipe_id = equipes.id
where projetos.status not in ('3')
and projetos.status_aprovacao not in ('0')
and projeto_roadmap.roadmap_id = " . $max_id . ")
union
(select projetos.id, projetos.descricao as projeto_descricao, projetos.status, projetos.status_aprovacao, projeto_roadmap.roadmap_id, projeto_roadmap.prioridade, equipes.descricao as equipe_descricao from projetos
left join projeto_roadmap on projetos.id = projeto_roadmap.projeto_id
left join equipes on projetos.equipe_id = equipes.id
where projetos.status not in ('3')
and projetos.status_aprovacao not in ('0')
and projeto_roadmap.projeto_id is null)) a
order by a.prioridade asc nulls last"));

        } else {

            $projetos = DB::select(DB::raw("select * from
((select projetos.id, projetos.descricao as projeto_descricao, projetos.status, projetos.status_aprovacao, projeto_roadmap.roadmap_id, projeto_roadmap.prioridade, equipes.descricao as equipe_descricao from projetos
left join projeto_roadmap on projetos.id = projeto_roadmap.projeto_id
left join equipes on projetos.equipe_id = equipes.id
where projetos.status not in ('3')
and projetos.status_aprovacao not in ('0')
and projeto_roadmap.roadmap_id = " . $id . ")
union
(select projetos.id, projetos.descricao as projeto_descricao, projetos.status, projetos.status_aprovacao, projeto_roadmap.roadmap_id, projeto_roadmap.prioridade, equipes.descricao as equipe_descricao from projetos
left join projeto_roadmap on projetos.id = projeto_roadmap.projeto_id
left join equipes on projetos.equipe_id = equipes.id
where projetos.status not in ('3')
and projetos.status_aprovacao not in ('0')
and projeto_roadmap.projeto_id is null)) a
order by a.prioridade asc nulls last"));
        }

        $atividades = DB::table('atividades')->select('atividades.projeto_id as projeto_id', 'atividades.id as id', 'atividades.competencia_id as competencia_id', 'atividades.descricao as descricao', 'atividades.data_inicio_real', 'alocacoes.data_inicio_proj', 'alocacoes.data_fim_proj',
            'atividades.percentual_real', 'projetos.descricao as projeto', 'recursos.nome as nome', 'atividades.recurso_real_id as recurso_real_id', 'projetos.equipe_id')
            ->leftJoin('projetos', 'atividades.projeto_id', '=', 'projetos.id')
            ->leftJoin('recursos', 'atividades.recurso_real_id', '=', 'recursos.id')
            ->leftJoinSub('SELECT DISTINCT on (atividade_id) * from alocacoes order by atividade_id,  roadmap_id DESC', 'alocacoes', function ($join) {
                $join->on('atividades.id', '=', 'alocacoes.atividade_id');
            })
            ->where('atividades.percentual_real', '<', 100)
            ->whereNotIn('projetos.status_aprovacao', [0])
            ->whereNotIn('projetos.status', [3])
            ->orderBy('projetos.id', 'ASC')
            ->orderBy('alocacoes.data_inicio_proj', 'ASC')
            ->orderBy('alocacoes.data_fim_proj', 'ASC')
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

    public function exportarRoadmap(Request $request)
    {

        $roadmap = Roadmap::find(intval($request->input('dados')['roadmap']));

        $exportar = $roadmap->exportarRoadmapExcel();

        $request->session()->forget('dados');

        return response()->json([

            'resultado' => $exportar

        ]);

    }

    public function gantt($id)
    {

        $roadmap = Roadmap::find($id);

        return view('roadmaps.gantt', ['roadmap' => $roadmap]);

    }

    public function ganttDados(Request $request)
    {

        $dados_ajax = $request->get('dados');

        $atividades = DB::table('atividades')->select(
            'atividades.id as atividade_id', 'atividades.projeto_id', 'atividades.descricao', 'atividades.prazo', DB::raw('coalesce(atividades.data_inicio_real, alocacoes.data_inicio_proj) as data_inicio'), DB::raw('coalesce(atividades.data_fim_real, alocacoes.data_fim_proj) as data_fim'), 'atividades.percentual_real',
            'competencias.descricao as competencia',
            'equipes.descricao as equipe',
            'recursos.nome as recurso',
            'projeto_roadmap.prioridade',
            'projetos.descricao as projeto', 'projetos.status', 'projetos.status_aprovacao')
            ->leftJoin('alocacoes', 'atividades.id', '=', 'alocacoes.atividade_id')
            ->leftJoin('projetos', 'atividades.projeto_id', '=', 'projetos.id')
            ->leftJoin('competencias', 'atividades.competencia_id', '=', 'competencias.id')
            ->leftJoin('equipes', 'projetos.equipe_id', '=', 'equipes.id')
            ->leftJoin('projeto_roadmap', function ($join) {
                $join->on('atividades.projeto_id', '=', 'projeto_roadmap.projeto_id')
                    ->on('alocacoes.roadmap_id', '=', 'projeto_roadmap.roadmap_id');
            })
            ->leftJoin('recursos', 'atividades.recurso_real_id', '=', 'recursos.id')
            ->orderBy('projeto_roadmap.prioridade', 'ASC')
            ->orderBy('atividades.atividade_codigo', 'ASC');

        $dependencias = DB::table('atividades')->select('atividade_dependencia.atividade_id as atividade', 'atividade_dependencia.dependencia_id as dependencia')
            ->leftJoin('atividade_dependencia', 'atividades.id', '=', 'atividade_dependencia.atividade_id')
            ->leftJoin('alocacoes', 'atividades.id', '=', 'alocacoes.atividade_id')
            ->leftJoin('projetos', 'atividades.projeto_id', '=', 'projetos.id');

        $projetos = DB::table('atividades')->select('atividades.projeto_id', DB::raw('COUNT(atividades.projeto_id) as qtd'))
            ->leftJoin('alocacoes', 'atividades.id', '=', 'alocacoes.atividade_id')
            ->leftJoin('roadmaps', 'alocacoes.roadmap_id', '=', 'roadmaps.id')
            ->leftJoin('projetos', 'atividades.projeto_id', '=', 'projetos.id')
            ->groupBy('atividades.projeto_id');

        if (isset($dados_ajax['projeto_id']) && !is_null($dados_ajax['projeto_id'])) {

            $atividades = $atividades->where('projetos.id', '=', $dados_ajax['projeto_id']);

            $dependencias = $dependencias->where('projetos.id', '=', $dados_ajax['projeto_id']);

            $projetos = $projetos->where('projetos.id', '=', $dados_ajax['projeto_id']);

        }

        if (isset($dados_ajax['roadmap_id']) && !is_null($dados_ajax['roadmap_id'])) {

            $atividades = $atividades->where('alocacoes.roadmap_id', '=', $dados_ajax['roadmap_id']);

            $dependencias = $dependencias->where('alocacoes.roadmap_id', '=', $dados_ajax['roadmap_id']);

            $projetos = $projetos->where('alocacoes.roadmap_id', '=', $dados_ajax['roadmap_id']);

        }

        $atividades = $atividades->get();

        $dependencias = $dependencias->get();

        $projetos = $projetos->get();

        return response()->json([

            'resultado' => ['atividades' => $atividades, 'dependencias' => $dependencias]

        ]);

    }

}

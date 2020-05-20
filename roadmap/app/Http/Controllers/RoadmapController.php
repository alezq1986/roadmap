<?php

namespace App\Http\Controllers;

use App\Equipe;
use App\Projeto;
use App\Roadmap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoadmapController extends Controller
{
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
        $validator = $this->roadmapValidator($request);

        if ($validator->fails()) {
            return redirect('roadmaps/create')
                ->withErrors($validator)
                ->withInput();
        } else {

            Roadmap::criarRoadmap($request);

            return redirect('roadmaps/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Roadmap $roadmap
     * @return \Illuminate\Http\Response
     */
    public function show(Roadmap $roadmap)
    {
        //
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
        $validator = $this->roadmapValidator($request);

        if ($validator->fails()) {
            return redirect('roadmaps/' . $roadmap->id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {

            $roadmap->atualizarRoadmap($request, $roadmap);

            return redirect('roadmaps/');
        }
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

    protected function roadmapValidator(Request $request)
    {
        return Validator::make($request->all(), [
            'data_base' => ['required', 'date'],
        ]);
    }

    public function configura($id)
    {
        $roadmap = Roadmap::find($id);

        $projetos_alocados = DB::table('projeto_roadmap')->where('roadmap_id', '=', $roadmap->id);

        $projetos = DB::table('projetos')
            ->select('projetos.id', 'projetos.descricao as projeto_descricao', 'projetos.status', 'projetos.status_aprovacao', 'projetos_alocados.roadmap_id', 'projetos_alocados.prioridade', 'equipes.descricao as equipe_descricao')
            ->leftjoinSub($projetos_alocados, 'projetos_alocados', function ($leftJoinSub) {
                $leftJoinSub->on('projetos.id', '=', 'projetos_alocados.projeto_id');
            })
            ->leftJoin('equipes', 'projetos.equipe_id', '=', 'equipes.id')
            ->whereNotIn('projetos.status', [3])
            ->orderBy('projetos_alocados.prioridade', 'ASC')
            ->get();


        return view('roadmaps.configura', ['projetos' => $projetos, 'roadmap' => $roadmap]);
    }
}

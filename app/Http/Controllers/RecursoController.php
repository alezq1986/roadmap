<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\Recurso;
use App\Feriado;
use App\FuncoesData;
use App\Roadmap;
use App\Pais;
use App\Estado;
use App\Municipio;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RecursoController extends Controller
{
    protected $rules = ['nome' => 'required|string|max:100',
        'data_inicio' => 'required|date',
        'data_fim' => 'required|date'];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $data = $request->all();

        $where = array();

        if (!empty($data)) {

            if ($request->has('id') && $request->get('id') != null) {
                array_push($where, ['id', '=', $request->get('id')]);
            }

            if ($request->has('nome') && $request->get('nome') != null) {
                array_push($where, ['nome', 'ilike', "%{$request->get('nome')}%"]);
            }

            if ($request->has('data_inicio_de') && $request->get('data_inicio_de') != null) {
                array_push($where, ['data_inicio', '>=', $request->get('data_inicio_de')]);
            }

            if ($request->has('data_inicio_ate') && $request->get('data_inicio_ate') != null) {
                array_push($where, ['data_inicio', '<=', $request->get('data_inicio_ate')]);
            }

            if ($request->has('data_fim_de') && $request->get('data_fim_de') != null) {
                array_push($where, ['data_fim', '>=', $request->get('data_fim_de')]);
            }

            if ($request->has('data_fim_ate') && $request->get('data_fim_ate') != null) {
                array_push($where, ['data_fim', '<=', $request->get('data_fim_ate')]);
            }

            $recursos = Recurso::where($where)->orderBy('id', 'ASC')->paginate(10);

        } else {

            $recursos = Recurso::orderBy('id', 'ASC')->paginate(10);
        }

        return view('recursos.index', ['recursos' => $recursos, 'data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('recursos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate($this->rules);

        Recurso::criarRecurso($request);

        return redirect('recursos/');

    }

    /**
     * Display the specified resource.
     *
     * @param Recurso $recurso
     * @return Response
     */
    public function show(Recurso $recurso)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Recurso $recurso
     * @return Response
     */
    public function edit(Recurso $recurso)
    {

        $competencias = $recurso->competencias;

        $equipes = $recurso->equipes;

        $bloqueios = $recurso->bloqueios;

        return view('recursos.edit', ['recurso' => $recurso, 'competencias' => $competencias, 'equipes' => $equipes, 'bloqueios' => $bloqueios]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Recurso $recurso
     * @return Response
     */
    public function update(Request $request, Recurso $recurso)
    {
        $request->validate($this->rules);

        Recurso::atualizarRecurso($request, $recurso);

        return redirect('recursos/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Recurso $recurso
     * @return Response
     */
    public function destroy(Recurso $recurso)
    {

        $recurso->destroy($recurso->id);

        return redirect('recursos/');
    }

}

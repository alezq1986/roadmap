<?php

namespace App\Http\Controllers;

use App\Competencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompetenciaController extends Controller
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

            if ($request->has('descricao') && $request->get('descricao') != null) {
                array_push($where, ['descricao', 'like', "%{$request->get('descricao')}%"]);
            }

            $competencias = Competencia::where($where)->paginate(10);

        } else {

            $competencias = Competencia::orderBy('id', 'ASC')->paginate(10);
        }

        return view('competencias.index', ['competencias' => $competencias, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('competencias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->competenciaValidator($request);

        if ($validator->fails()) {
            return redirect('competencias/create')
                ->withErrors($validator)
                ->withInput();
        } else {

            Competencia::criarCompetencia($request);

            return redirect('competencias/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Competencia $competencia
     * @return void
     */
    public function show(Competencia $competencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Competencia $competencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Competencia $competencia)
    {
        return view('competencias.edit', ['competencia' => $competencia]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Competencia $competencia
     * @return void
     */
    public function update(Request $request, Competencia $competencia)
    {

        $validator = $this->competenciaValidator($request);

        if ($validator->fails()) {
            return redirect('competencias/' . $competencia->id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {

            $competencia->atualizarCompetencia($request, $competencia);

            return redirect('competencias/');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Competencia $competencia
     * @return void
     */
    public function destroy(Competencia $competencia)
    {
        $competencia->destroy($competencia->id);

        return redirect('competencias/');
    }

    protected function competenciaValidator(array $data)
    {
        return Validator::make($data, [
            'desricao' => ['required', 'string', 'max:100'],
        ]);
    }
}

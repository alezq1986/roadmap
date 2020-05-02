<?php

namespace App\Http\Controllers;

use App\Recurso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecursoController extends Controller
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

            if ($request->has('nome') && $request->get('nome') != null) {
                array_push($where, ['nome', 'like', "%{$request->get('nome')}%"]);
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recursos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->recursoValidator($request);

        if ($validator->fails()) {
            return redirect('recursos/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            Recurso::create([
                'nome' => $request->input('nome'),
                'data_inicio' => $request->input('data_inicio'),
                'data_fim' => $request->input('data_fim'),
            ]);

            return redirect('recursos/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Recurso $recurso
     * @return \Illuminate\Http\Response
     */
    public function show(Recurso $recurso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Recurso $recurso
     * @return \Illuminate\Http\Response
     */
    public function edit(Recurso $recurso)
    {
        return view('recursos.edit', ['recurso' => $recurso]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Recurso $recurso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recurso $recurso)
    {

        $validator = $this->recursoValidator($request);

        if ($validator->fails()) {
            return redirect('recursos/' . $recurso->id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {

            $recurso->nome = $request->input('nome');
            $recurso->data_inicio = $request->input('data_inicio');
            $recurso->data_fim = $request->input('data_fim');

            $recurso->save();

            return redirect('recursos/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Recurso $recurso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recurso $recurso)
    {
        //
    }

    protected function recursoValidator(Request $request)
    {
        return Validator::make($request->all(), [
            'nome' => ['required', 'string', 'max:100'],
            'data_inicio' => ['required', 'date'],
            'data_fim' => ['required', 'date'],
        ]);
    }
}

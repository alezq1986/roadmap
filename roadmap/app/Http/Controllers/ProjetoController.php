<?php

namespace App\Http\Controllers;

use App\Projeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProjetoController extends Controller
{

    protected $rules = ['descricao' => 'required|string|max:100'];

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

            $projetos = Projeto::where($where)->orderBy('id', 'ASC')->paginate(10);

        } else {

            $projetos = Projeto::orderBy('id', 'ASC')->paginate(10);
        }

        return view('projetos.index', ['projetos' => $projetos, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projetos.create');
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

        Projeto::criarProjeto($request);

        return redirect('projetos/');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\projeto $projeto
     * @return void
     */
    public function show(projeto $projeto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Projeto $projeto
     * @return \Illuminate\Http\Response
     */
    public function edit(Projeto $projeto)
    {
        $atividades = $projeto->atividades;

        return view('projetos.edit', ['projeto' => $projeto, 'atividades' => $atividades]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Projeto $projeto
     * @return void
     */
    public function update(Request $request, Projeto $projeto)
    {

        $request->validate($this->rules);

        $projeto->atualizarProjeto($request, $projeto);

        return redirect('projetos/');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Projeto $projeto
     * @return void
     */
    public function destroy(Projeto $projeto)
    {
        $projeto->destroy($projeto->id);

        return redirect('projetos/');
    }


    public function incluirProjetosRoadmap(Request $request)
    {
        $dados = $request->input('dados');

        try {

            $resultado = DB::transaction(function () use ($dados) {

                DB::table('projeto_roadmap')->where('roadmap_id', '=', $dados['roadmap'])->delete();

                $max_id = DB::table('projeto_roadmap')->max('id');

                $max_id = is_null($max_id) ? 1 : $max_id;

                DB::update(DB::raw('ALTER SEQUENCE projeto_roadmap_id_seq RESTART WITH ' . $max_id));

                DB::table('projeto_roadmap')->insert($dados['projetos']);

            });

        } catch (Exception $e) {

            return 1;
        }

        $request->session()->forget('dados');

        return response()->json([

            'resultado' => $resultado

        ]);
    }

}

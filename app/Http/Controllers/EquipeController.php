<?php

namespace App\Http\Controllers;

use App\Equipe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EquipeController extends Controller
{

    protected $rules = ['descricao' => 'required|string|max:100'];

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

            if ($request->has('descricao') && $request->get('descricao') != null) {
                array_push($where, ['descricao', 'ilike', "%{$request->get('descricao')}%"]);
            }

            $equipes = Equipe::where($where)->paginate(10);

        } else {

            $equipes = Equipe::orderBy('id', 'ASC')->paginate(10);
        }

        return view('equipes.index', ['equipes' => $equipes, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('equipes.create');
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

        equipe::criarEquipe($request);

        return redirect('equipes/');

    }

    /**
     * Display the specified resource.
     *
     * @param Equipe $equipe
     * @return void
     */
    public function show(equipe $equipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Equipe $equipe
     * @return Response
     */
    public function edit(Equipe $equipe)
    {
        return view('equipes.edit', ['equipe' => $equipe]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Equipe $equipe
     * @return void
     */
    public function update(Request $request, Equipe $equipe)
    {

        $request->validate($this->rules);

        $equipe->atualizarEquipe($request, $equipe);

        return redirect('equipes/');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Equipe $equipe
     * @return void
     */
    public function destroy(Equipe $equipe)
    {
        $equipe->destroy($equipe->id);

        return redirect('equipes/');
    }

}

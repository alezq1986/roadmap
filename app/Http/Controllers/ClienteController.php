<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    protected $rules = ['nome' => 'required|string|max:100'];

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
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
                array_push($where, ['nome', 'ilike', "%{$request->get('nome')}%"]);
            }

            $clientes = Cliente::where($where)->paginate(10);

        } else {

            $clientes = Cliente::orderBy('id', 'ASC')->paginate(10);
        }

        return view('clientes.index', ['clientes' => $clientes, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
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

        Cliente::criarCliente($request);

        return redirect('clientes/');
    }

    /**
     * Display the specified resource.
     *
     * @param Cliente $cliente
     * @return void
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Cliente $cliente
     * @return void
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate($this->rules);

        $cliente->atualizarCliente($request, $cliente);

        return redirect('clientes/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Cliente $cliente
     * @return void
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->destroy($cliente->id);

        return redirect('clientes/');
    }
}

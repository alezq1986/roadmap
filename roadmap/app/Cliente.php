<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Cliente extends Model
{
    protected $fillable = ['nome'];

    public function projetos()
    {
        return $this->hasMany('App\Projeto');
    }

    public static function criarCliente(Request $request)
    {

        DB::transaction(function () use ($request) {

            $cliente = Cliente::create([
                'nome' => $request->input('nome'),
            ]);

            if ($request->session()->has('filhos')) {

                FuncoesFilhos::criarFilhos($request, $cliente);
            }

            if ($request->session()->has('filhos_pivot')) {

                FuncoesFilhos::criarFilhosPivot($request, $cliente);
            }

        });
    }

    public static function atualizarCliente(Request $request, Cliente $cliente)
    {
        DB::transaction(function () use ($request, $cliente) {

            $cliente->nome = $request->input('nome');

            $cliente->save();

            if ($request->session()->has('filhos')) {

                FuncoesFilhos::criarFilhos($request, $cliente);

            }

            if ($request->session()->has('filhos_pivot')) {

                FuncoesFilhos::criarFilhosPivot($request, $cliente);
            }

        });
    }
}

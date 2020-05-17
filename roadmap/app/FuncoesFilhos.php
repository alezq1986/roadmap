<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FuncoesFilhos extends Model
{

    /**
     * @param Request $request
     * @param Model $modelo
     * @throws \ReflectionException
     */
    public static function criarFilhos(Request $request, Model $modelo)
    {
        $desc_modelo = strtolower((new \ReflectionClass($modelo))->getShortName());

        if (isset($request->session()->get('filhos')['filhos_incluir'])) {

            foreach ($request->session()->get('filhos')['filhos_incluir'] as $filho) {

                $desc_modelo_relacionado = strtolower($filho['modelo']);

                if (strcmp($desc_modelo, $desc_modelo_relacionado) <= 0) {

                    $tabela = $desc_modelo . '_' . $desc_modelo_relacionado;

                } else {

                    $tabela = $desc_modelo_relacionado . '_' . $desc_modelo;
                }

                DB::table($tabela)->insertOrIgnore([
                    $desc_modelo . '_id' => $modelo->id,
                    $desc_modelo_relacionado . '_id' => $filho['id']
                ]);

            }
        }

        if (isset($request->session()->get('filhos')['filhos_deletar'])) {

            foreach ($request->session()->get('filhos')['filhos_deletar'] as $filho) {

                $desc_modelo_relacionado = strtolower($filho['modelo']);

                if (strcmp($desc_modelo, $desc_modelo_relacionado) <= 0) {

                    $tabela = $desc_modelo . '_' . $desc_modelo_relacionado;

                } else {

                    $tabela = $desc_modelo_relacionado . '_' . $desc_modelo;
                }

                DB::table($tabela)->where(
                    $desc_modelo . '_id', '=', $modelo->id
                )->where(
                    $desc_modelo_relacionado . '_id', '=', $filho['id']
                )->delete();

            }
        }
        $request->session()->forget('filhos');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;

class FuncoesFilhos extends Model
{

    /**
     * @param Request $request
     * @param Model $modelo_principal
     * @return \Illuminate\Http\RedirectResponse
     * @throws \ReflectionException
     */
    public static function criarFilhos(Request $request, Model $modelo_principal)
    {


        if ($request->session()->has('filhos')) {

            $filhos = $request->session()->get('filhos');

            foreach ($filhos as $tabela => $conteudo) {

                if (strpos($tabela, '_') === false) {

                    if (substr($tabela, -3) == 'ses') {

                        $modelo = ucfirst(substr($tabela, 0, -2));

                    } else {

                        $modelo = ucfirst(substr($tabela, 0, -1));
                    }

                    $modelo = 'App\\' . $modelo;

                    if (isset($conteudo['filhos_incluir'])) {

                        foreach ($conteudo['filhos_incluir'] as $filho_incluir) {

                            $dados = array_filter($filho_incluir, function ($coluna) {

                                return $coluna != 'id';

                            }, ARRAY_FILTER_USE_KEY);

                            if (is_numeric($filho_incluir['id'])) {

                                $atualizado = $modelo::find($filho_incluir['id']);

                                foreach ($dados as $coluna => $valor) {

                                    $atualizado->$coluna = $valor;

                                }

                                $atualizado->save();

                            } else {

                                $chave_estrangeira = strtolower((new \ReflectionClass($modelo_principal))->getShortName()) . "_id";

                                $chave_estrangeira_valor = $modelo_principal->id;

                                $dados[$chave_estrangeira] = $chave_estrangeira_valor;

                                $modelo::create($dados);

                            }

                        }

                    }

                    if (isset($conteudo['filhos_deletar'])) {

                        foreach ($conteudo['filhos_deletar'] as $filho_deletar) {

                            $deletado = $modelo::find($filho_deletar['id']);

                            $deletado->delete();

                        }

                    }

                } else {

                    if (isset($conteudo['filhos_incluir'])) {

                        foreach ($conteudo['filhos_incluir'] as $filho_incluir) {

                            $dados = array_filter($filho_incluir, function ($coluna) {

                                return $coluna != 'id';

                            }, ARRAY_FILTER_USE_KEY);

                            $modelo_pivot = strtolower((new \ReflectionClass($modelo_principal))->getShortName());

                            $dados[$modelo_pivot . '_id'] = $modelo_principal->id;

                            DB::table($tabela)->insertOrIgnore([
                                $dados
                            ]);

                        }
                    }

                    if (isset($conteudo['filhos_deletar'])) {

                        foreach ($conteudo['filhos_deletar'] as $filho_deletar) {

                            $dados = array_filter($filho_deletar, function ($coluna) {

                                return $coluna != 'id';

                            }, ARRAY_FILTER_USE_KEY);

                            $delete = DB::table($tabela);

                            foreach ($dados as $coluna => $valor) {

                                $delete = $delete->where($coluna, '=', $valor);

                            }

                            $delete->delete();
                        }

                    }

                }


            }

        }

        $request->session()->forget('filhos');
    }

}

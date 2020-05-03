<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function ajaxRequestPost(Request $request)
    {

        $classe = 'App\\' . $request->input('class');

        if (is_numeric($request->input('id'))) {

            $resultado = $classe::where('id', '=', $request->input('id'))->get();

        } else {

            $resultado = $classe::where('descricao', 'ilike', "%{$request->input('id')}%")->get();

        }

        return response()->json([
            'success' => $resultado
        ]);

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AjaxController extends Controller
{
    public function ajaxRequestPost(Request $request)
    {

        $data = $request->all();


        return response()->json([
            'success' => 'get your data'
        ]);

    }
}

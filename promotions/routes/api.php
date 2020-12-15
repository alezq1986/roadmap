<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('shoppingcarts', 'ApiController@getAllShoppingCarts');
Route::get('shoppingcart/{id}', 'ApiController@getShoppingCart');
Route::post('shoppingcart', 'ApiController@createShoppingCart');
Route::put('shoppingcart/{id}', 'ApiController@updateShoppingCart');
Route::delete('shoppingcart/{id}','ApiController@deleteShoppingCart');

Route::post('applypromotions','ApiController@applyPromotions');

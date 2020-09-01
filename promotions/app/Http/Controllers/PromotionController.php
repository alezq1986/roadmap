<?php

namespace App\Http\Controllers;

use App\ShoppingCartItem;
use Illuminate\Http\Request;
use App\ShoppingCart;
use App\Promotion;
use Decimal\Decimal;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function calculatePromotions()
    {

        $a = Promotion::calculate_promotions(ShoppingCart::find(1));

        $b=1;

//        $sc = ShoppingCart::find(1);
//        $sc->calculated_items = $sc->items;
//        $sc->dismember('789124');
//
//        echo "<pre>";
//        print_r($sc->calculated_items);
//        print_r($sc->calculated_items[1]);
//        print_r($sc->calculated_items[1]->quantity);
//        echo "</pre>";


    }

}

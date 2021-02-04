<?php

namespace App\Http\Controllers;

use App\ShoppingCart;
use App\ShoppingCartItem;
use App\Promotion;
use App\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public function applyPromotions(Request $request)
    {

        $request_content = json_decode($request->getContent());

        //1: salvo o carrinho
        try {

            $sc = DB::transaction(function () use ($request_content) {

                $sc = ShoppingCart::firstOrNew(['external_id' => $request_content->external_id]);
                $sc->external_id = $request_content->external_id;
                $sc->customer_id = $request_content->customer_id;
                $sc->item_quantity = $request_content->item_quantity;
                $sc->value = $request_content->value;
                $sc->discount = $request_content->discount;
                $sc->net_value = $request_content->net_value;
                $sc->save();

                foreach ($request_content->items as $item) {

                    $sci = ShoppingCartItem::create([
                        'shopping_cart_id' => $sc->id,
                        'index' => $item->index,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'unit_value' => $item->unit_value,
                        'value' => $item->value,
                        'discount' => $item->discount,
                        'net_value' => $item->net_value,
                    ]);

                }

                return $sc;

            });

            //2: calculo as promoções
           $calculated_sc = calculatePromotions($sc, Parameter::where('param_code', 1)->first()->value);

            return response()->json([
                "message" => "Shopping Cart record created"
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                "message" => "Bad request"
            ], 400);

        }

    }

    public function createShoppingCart(Request $request)
    {

        try {

            $resultado = DB::transaction(function () use ($request) {

                $sc = Shoppingcart::create([
                    'external_id' => $request->external_id,
                    'customer_id' => $request->customer_id,
                    'item_quantity' => $request->item_quantity,
                    'value' => $request->value,
                    'discount' => $request->discount,
                    'net_value' => $request->net_value,
                ]);

                return $sc;

            });

            return response()->json([
                "message" => "Promotion applied"
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                "message" => "Bad promotion request"
            ], 400);

        }

    }

    public function getShoppingCart($id)
    {

        if (ShoppingCart::where('id', $id)->exists()) {

            $sc = ShoppingCart::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);

            return response($sc, 200);

        } else {

            return response()->json([

                "message" => "Shopping Cart not found"

            ], 404);
        }
    }

    public function updateShoppingCart(Request $request, $id)
    {
        // logic to update a student record goes here
    }

    public function deleteShoppingCart($id)
    {
        // logic to delete a student record goes here
    }
}

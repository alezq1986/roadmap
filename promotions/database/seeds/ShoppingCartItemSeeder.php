<?php

use Illuminate\Database\Seeder;
use App\ShoppingCartItem;

class ShoppingCartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::update(DB::raw('truncate table shopping_cart_items restart identity cascade'));

        ShoppingCartItem::create(['shopping_cart_id' => 1, 'product_id' => '789123', 'quantity' => 3, 'unit_value' => 80.00, 'value' => 240.00, 'promotion_discount' => null, 'net_value' => null]);
        ShoppingCartItem::create(['shopping_cart_id' => 1, 'product_id' => '789124', 'quantity' => 4, 'unit_value' => 20.00, 'value' => 80.00, 'promotion_discount' => null, 'net_value' => null]);
        ShoppingCartItem::create(['shopping_cart_id' => 1, 'product_id' => '789125', 'quantity' => 4, 'unit_value' => 10.00, 'value' => 40.00, 'promotion_discount' => null, 'net_value' => null]);
        ShoppingCartItem::create(['shopping_cart_id' => 1, 'product_id' => '789124', 'quantity' => 1, 'unit_value' => 20.00, 'value' => 20.00, 'promotion_discount' => null, 'net_value' => null]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\ShoppingCart;

class ShoppingCartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::update(DB::raw('truncate table shopping_carts restart identity cascade'));

        ShoppingCart::create(['external_id' => '123', 'customer_id' => '34005301827', 'item_quantity' => 11, 'value' => 340.00, 'discount' => null, 'net_value' => null]);
    }
}

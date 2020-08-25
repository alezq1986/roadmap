<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::update(DB::raw('truncate table products restart identity cascade'));

        Product::create(['product_id'=> '789123', 'category_1_id' => 1, 'category_2_id' => 1, 'category_3_id' => 1, 'category_4_id' => 1, 'category_5_id' => 1]);
        Product::create(['product_id'=> '789124', 'category_1_id' => 2, 'category_2_id' => 2, 'category_3_id' => 2, 'category_4_id' => 2, 'category_5_id' => 2]);
        Product::create(['product_id'=> '789125', 'category_1_id' => 1, 'category_2_id' => 1, 'category_3_id' => 2, 'category_4_id' => 5, 'category_5_id' => 6]);
    }
}

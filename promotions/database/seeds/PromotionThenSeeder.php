<?php

use Illuminate\Database\Seeder;
use App\PromotionThen;

class PromotionThenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::update(DB::raw('truncate table promotion_thens restart identity cascade'));

        PromotionThen::create(['promotion_id' => 1, 'type' => 1, 'discount_type' => 1, 'discount_value' => 10.00, 'quantity' => 2, 'product_id' => '789125','category_level' => null, 'category_id' => null]);
        PromotionThen::create(['promotion_id' => 1, 'type' => 1, 'discount_type' => 0, 'discount_value' => 1.50, 'quantity' => 1, 'product_id' => '789124','category_level' => null, 'category_id' => null]);
        PromotionThen::create(['promotion_id' => 1, 'type' => 0, 'discount_type' => 0, 'discount_value' => 20.00, 'quantity' => null, 'product_id' => null,'category_level' => null, 'category_id' => null]);
        PromotionThen::create(['promotion_id' => 1, 'type' => 2, 'discount_type' => 1, 'discount_value' => 5.00, 'quantity' => 1, 'product_id' => null,'category_level' => 5, 'category_id' => 1]);
    }
}

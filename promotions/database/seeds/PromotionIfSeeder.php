<?php

use Illuminate\Database\Seeder;
use App\PromotionIf;

class PromotionIfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::update(DB::raw('truncate table promotion_ifs restart identity cascade'));

        PromotionIf::create(['promotion_id' => 1, 'type' => 1, 'amount_type' => 0, 'product_id' => '789123', 'category_level' => null, 'category_id' => null, 'quantity' => null, 'value' => 100.00]);
        PromotionIf::create(['promotion_id' => 1, 'type' => 1, 'amount_type' => 1, 'product_id' => '789124', 'category_level' => null, 'category_id' => null, 'quantity' => 2, 'value' => null]);
        PromotionIf::create(['promotion_id' => 1, 'type' => 0, 'amount_type' => 0, 'product_id' => null, 'category_level' => null, 'category_id' => null, 'quantity' => 0, 'value' => 300.00]);

    }
}

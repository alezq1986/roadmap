<?php

use Illuminate\Database\Seeder;
use App\Promotion;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::update(DB::raw('truncate table promotions restart identity cascade'));

        Promotion::create(['start_date' => '2020-08-01', 'end_date' =>'2020-12-31', 'active' => 1, 'max_times' => 2, 'expression' =>'MIN(MAX(if_1, if_2), if_3)']);

    }
}

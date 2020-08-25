<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ParameterSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ShoppingCartSeeder::class);
        $this->call(ShoppingCartItemSeeder::class);
        $this->call(PromotionSeeder::class);
        $this->call(PromotionIfSeeder::class);
        $this->call(PromotionThenSeeder::class);
    }
}

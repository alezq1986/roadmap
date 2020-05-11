<?php

use App\Roadmap;
use Illuminate\Database\Seeder;

class RoadmapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $r1 = Roadmap::create(['data_base' => '2020-04-03']);
    }
}

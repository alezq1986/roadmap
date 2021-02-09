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
        DB::update(DB::raw('truncate table roadmaps restart identity cascade'));

        Roadmap::create(['descricao' => 'Roadmap 15/01/2021', 'alocado' => 2, 'data_base' => '2021-1-15']);

    }
}

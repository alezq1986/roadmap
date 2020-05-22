<?php

use App\Projeto;
use App\Roadmap;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjetoRoadmapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::update(DB::raw('truncate table projeto_roadmap restart identity cascade'));

    }
}

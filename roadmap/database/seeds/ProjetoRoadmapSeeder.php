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

        DB::table('projeto_roadmap')->insert(['projeto_id' => 58, 'roadmap_id' => 1, 'prioridade' => 1]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 175, 'roadmap_id' => 1, 'prioridade' => 2]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 87, 'roadmap_id' => 1, 'prioridade' => 3]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 176, 'roadmap_id' => 1, 'prioridade' => 4]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 62, 'roadmap_id' => 1, 'prioridade' => 5]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 138, 'roadmap_id' => 1, 'prioridade' => 6]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 177, 'roadmap_id' => 1, 'prioridade' => 7]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 178, 'roadmap_id' => 1, 'prioridade' => 8]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 125, 'roadmap_id' => 1, 'prioridade' => 9]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 179, 'roadmap_id' => 1, 'prioridade' => 10]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 82, 'roadmap_id' => 1, 'prioridade' => 11]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 180, 'roadmap_id' => 1, 'prioridade' => 12]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 181, 'roadmap_id' => 1, 'prioridade' => 13]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 182, 'roadmap_id' => 1, 'prioridade' => 14]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 183, 'roadmap_id' => 1, 'prioridade' => 15]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 184, 'roadmap_id' => 1, 'prioridade' => 16]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 185, 'roadmap_id' => 1, 'prioridade' => 17]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 186, 'roadmap_id' => 1, 'prioridade' => 18]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 187, 'roadmap_id' => 1, 'prioridade' => 19]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 188, 'roadmap_id' => 1, 'prioridade' => 20]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 141, 'roadmap_id' => 1, 'prioridade' => 21]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 189, 'roadmap_id' => 1, 'prioridade' => 22]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 117, 'roadmap_id' => 1, 'prioridade' => 23]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 190, 'roadmap_id' => 1, 'prioridade' => 24]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 191, 'roadmap_id' => 1, 'prioridade' => 25]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 192, 'roadmap_id' => 1, 'prioridade' => 26]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 193, 'roadmap_id' => 1, 'prioridade' => 27]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 194, 'roadmap_id' => 1, 'prioridade' => 28]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 195, 'roadmap_id' => 1, 'prioridade' => 29]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 67, 'roadmap_id' => 1, 'prioridade' => 30]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 68, 'roadmap_id' => 1, 'prioridade' => 31]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 69, 'roadmap_id' => 1, 'prioridade' => 32]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 79, 'roadmap_id' => 1, 'prioridade' => 33]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 90, 'roadmap_id' => 1, 'prioridade' => 34]);
        DB::table('projeto_roadmap')->insert(['projeto_id' => 123, 'roadmap_id' => 1, 'prioridade' => 35]);

    }
}

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
        $roadmap = Roadmap::first();

        $projetos = Projeto::all();

        $prioridade = 1;

        foreach ($projetos as $projeto) {

            $pr = DB::table('projeto_roadmap')->insert([
                'projeto_id' => $projeto->id,
                'roadmap_id' => $roadmap->id,
                'prioridade' => $prioridade
            ]);

            $prioridade++;
        }
    }
}

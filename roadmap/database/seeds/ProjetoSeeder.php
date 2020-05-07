<?php

use App\Projeto;
use Illuminate\Database\Seeder;

class ProjetoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p1 = Projeto::create(['descricao' => 'Projeto Teste 1', 'prioridade' => 1, 'equipe_id' => 1]);
        $p2 = Projeto::create(['descricao' => 'Projeto Teste 2', 'prioridade' => 2, 'equipe_id' => 1]);
        $p3 = Projeto::create(['descricao' => 'Projeto Teste 3', 'prioridade' => 3, 'equipe_id' => 1]);
        $p4 = Projeto::create(['descricao' => 'Projeto Teste 4', 'prioridade' => 4, 'equipe_id' => 1]);
        $p5 = Projeto::create(['descricao' => 'Projeto Teste 5', 'prioridade' => 5, 'equipe_id' => 1]);
    }
}

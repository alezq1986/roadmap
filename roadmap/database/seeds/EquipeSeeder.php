<?php

use App\Equipe;
use Illuminate\Database\Seeder;

class EquipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $e1 = Equipe::create(['descricao' => 'Projetos Base']);
        $e2 = Equipe::create(['descricao' => 'Makro']);
        $e3 = Equipe::create(['descricao' => 'SaaS']);
        $e4 = Equipe::create(['descricao' => 'Projetos Novos']);
        $e5 = Equipe::create(['descricao' => 'Inovação']);
    }
}

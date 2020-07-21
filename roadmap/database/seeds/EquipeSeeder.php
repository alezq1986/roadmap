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
        DB::update(DB::raw('truncate table equipes restart identity cascade'));

        Equipe::create(['descricao' => 'Projetos Base']);
        Equipe::create(['descricao' => 'Makro']);
        Equipe::create(['descricao' => 'SaaS']);
        Equipe::create(['descricao' => 'Projetos Novos']);
        Equipe::create(['descricao' => 'Inovação']);
        Equipe::create(['descricao' => 'Comper']);
    }
}

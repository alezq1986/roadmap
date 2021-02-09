<?php

use App\Bloqueio;
use Illuminate\Database\Seeder;

class BloqueioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::update(DB::raw('truncate table bloqueios restart identity cascade'));

//        Bloqueio::create(['recurso_id' => 1, 'data_inicio' => '2020-03-01', 'data_fim' => '2020-03-15']);
//        Bloqueio::create(['recurso_id' => 1, 'data_inicio' => '2020-06-10', 'data_fim' => '2020-06-30']);
    }
}

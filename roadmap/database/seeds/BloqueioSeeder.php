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
        $b1 = Bloqueio::create(['recurso_id' => 1, 'data_inicio' => '2020-03-01', 'data_fim' => '2020-03-15']);
        $b1 = Bloqueio::create(['recurso_id' => 1, 'data_inicio' => '2020-06-10', 'data_fim' => '2020-06-30']);
    }
}

<?php

use Illuminate\Database\Seeder;

class AtividadeDependenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ad1 = DB::table('atividade_dependencia')->insert([
            'atividade_id' => 5,
            'dependencia_id' => 4
        ]);
    }
}

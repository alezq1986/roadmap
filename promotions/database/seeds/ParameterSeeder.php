<?php

use Illuminate\Database\Seeder;
use App\Parameter;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::update(DB::raw('truncate table parameters restart identity cascade'));

        //0 - não; 1 - sim
        Parameter::create(['param_code' => 1, 'param_value' => '1', 'description' => 'Promoções cumulativas']);
        Parameter::create(['param_code' => 2, 'param_value' => '0.01', 'description' => 'Valor mínimo do produto']);
        //0 - agrupar itens e aplicar sobre o valor médio do item; 1 - desmembrar itens e aplicar sobre os de maior valor
        Parameter::create(['param_code' => 2, 'param_value' => '0.01', 'description' => 'Tratamento de promoções cumulativas']);


    }
}

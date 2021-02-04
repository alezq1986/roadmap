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
        Parameter::create(['param_code' => 1, 'param_value' => '0', 'description' => 'Promoções cumulativas']);
        Parameter::create(['param_code' => 2, 'param_value' => '0.01', 'description' => 'Valor mínimo do produto']);
        //0 - agrupar itens e aplicar sobre o valor médio do item; 1 - manter como registrado e aplicar sobre os de maior valor
        Parameter::create(['param_code' => 3, 'param_value' => '1', 'description' => 'Tratamento de valor dos itens']);
        //0 - calcular desconto sobre valor bruto; 1 - calcular desconto sobre valor líquido
        Parameter::create(['param_code' => 4, 'param_value' => '0.01', 'description' => 'Tratamento de valor dos itens']);


    }
}

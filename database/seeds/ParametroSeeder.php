<?php

use App\Parametro;
use Illuminate\Database\Seeder;

class ParametroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parametro::create(['codigo' => 1, 'valor' => 3832, 'descricao' => 'Município padrão']);
    }
}

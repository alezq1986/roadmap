<?php

use App\Feriado;
use Illuminate\Database\Seeder;

class FeriadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $f1 = Feriado::create(['descricao' => 'Confraternização Universal', 'data' => '2020-1-1', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        $f2 = Feriado::create(['descricao' => 'Carnaval', 'data' => '2020-2-24', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        $f3 = Feriado::create(['descricao' => 'Carnaval', 'data' => '2020-2-25', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        $f4 = Feriado::create(['descricao' => 'Paixão de Cristo', 'data' => '2020-4-10', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        $f5 = Feriado::create(['descricao' => 'Tiradentes', 'data' => '2020-4-21', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        $f6 = Feriado::create(['descricao' => 'Dia do Trabalho', 'data' => '2020-5-1', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        $f7 = Feriado::create(['descricao' => 'Corpus Christi', 'data' => '2020-6-11', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        $f8 = Feriado::create(['descricao' => 'Independência do Brasil', 'data' => '2020-9-7', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        $f9 = Feriado::create(['descricao' => 'Nossa Senhora Aparecida', 'data' => '2020-10-12', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        $f10 = Feriado::create(['descricao' => 'Finados', 'data' => '2020-11-2', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        $f11 = Feriado::create(['descricao' => 'Proclamação da República', 'data' => '2020-11-15', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        $f12 = Feriado::create(['descricao' => 'Natal', 'data' => '2020-12-25', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        $f13 = Feriado::create(['descricao' => 'Revolução Constitucionalista', 'data' => '2020-07-09', 'entidade_id' => 20, 'entidade_tipo' => 'App\Estado']);
        $f14 = Feriado::create(['descricao' => 'Fundação da Cidade', 'data' => '2020-01-25', 'entidade_id' => 3832, 'entidade_tipo' => 'App\Municipio']);
        $f15 = Feriado::create(['descricao' => 'Consciência Negra', 'data' => '2020-11-20', 'entidade_id' => 19, 'entidade_tipo' => 'App\Estado']);
    }
}

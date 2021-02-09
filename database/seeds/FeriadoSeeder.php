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
        DB::update(DB::raw('truncate table feriados restart identity cascade'));

        Feriado::create(['descricao' => 'Confraternização Universal', 'data' => '2020-1-1', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        Feriado::create(['descricao' => 'Carnaval', 'data' => '2020-2-24', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        Feriado::create(['descricao' => 'Carnaval', 'data' => '2020-2-25', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        Feriado::create(['descricao' => 'Paixão de Cristo', 'data' => '2020-4-10', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        Feriado::create(['descricao' => 'Tiradentes', 'data' => '2020-4-21', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        Feriado::create(['descricao' => 'Dia do Trabalho', 'data' => '2020-5-1', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        Feriado::create(['descricao' => 'Corpus Christi', 'data' => '2020-6-11', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        Feriado::create(['descricao' => 'Independência do Brasil', 'data' => '2020-9-7', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        Feriado::create(['descricao' => 'Nossa Senhora Aparecida', 'data' => '2020-10-12', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        Feriado::create(['descricao' => 'Finados', 'data' => '2020-11-2', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        Feriado::create(['descricao' => 'Proclamação da República', 'data' => '2020-11-15', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        Feriado::create(['descricao' => 'Natal', 'data' => '2020-12-25', 'entidade_id' => 30, 'entidade_tipo' => 'App\Pais']);
        Feriado::create(['descricao' => 'Revolução Constitucionalista', 'data' => '2020-07-09', 'entidade_id' => 20, 'entidade_tipo' => 'App\Estado']);
        Feriado::create(['descricao' => 'Fundação da Cidade', 'data' => '2020-01-25', 'entidade_id' => 3832, 'entidade_tipo' => 'App\Municipio']);
        Feriado::create(['descricao' => 'Consciência Negra', 'data' => '2020-11-20', 'entidade_id' => 19, 'entidade_tipo' => 'App\Estado']);
    }
}

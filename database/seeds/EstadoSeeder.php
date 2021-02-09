<?php

use App\Estado;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::update(DB::raw('truncate table estados restart identity cascade'));

        Estado::create(['descricao' => 'Rondônia', 'codigo_interno' => 11, 'pais_id' => 30, 'sigla' => 'RO']);
        Estado::create(['descricao' => 'Acre', 'codigo_interno' => 12, 'pais_id' => 30, 'sigla' => 'AC']);
        Estado::create(['descricao' => 'Amazonas', 'codigo_interno' => 13, 'pais_id' => 30, 'sigla' => 'AM']);
        Estado::create(['descricao' => 'Roraima', 'codigo_interno' => 14, 'pais_id' => 30, 'sigla' => 'RR']);
        Estado::create(['descricao' => 'Pará', 'codigo_interno' => 15, 'pais_id' => 30, 'sigla' => 'PA']);
        Estado::create(['descricao' => 'Amapá', 'codigo_interno' => 16, 'pais_id' => 30, 'sigla' => 'AP']);
        Estado::create(['descricao' => 'Tocantins', 'codigo_interno' => 17, 'pais_id' => 30, 'sigla' => 'TO']);
        Estado::create(['descricao' => 'Maranhão', 'codigo_interno' => 21, 'pais_id' => 30, 'sigla' => 'MA']);
        Estado::create(['descricao' => 'Piauí', 'codigo_interno' => 22, 'pais_id' => 30, 'sigla' => 'PI']);
        Estado::create(['descricao' => 'Ceará', 'codigo_interno' => 23, 'pais_id' => 30, 'sigla' => 'CE']);
        Estado::create(['descricao' => 'Rio Grande do Norte', 'codigo_interno' => 24, 'pais_id' => 30, 'sigla' => 'RN']);
        Estado::create(['descricao' => 'Paraíba', 'codigo_interno' => 25, 'pais_id' => 30, 'sigla' => 'PB']);
        Estado::create(['descricao' => 'Pernambuco', 'codigo_interno' => 26, 'pais_id' => 30, 'sigla' => 'PE']);
        Estado::create(['descricao' => 'Alagoas', 'codigo_interno' => 27, 'pais_id' => 30, 'sigla' => 'AL']);
        Estado::create(['descricao' => 'Sergipe', 'codigo_interno' => 28, 'pais_id' => 30, 'sigla' => 'SE']);
        Estado::create(['descricao' => 'Bahia', 'codigo_interno' => 29, 'pais_id' => 30, 'sigla' => 'BA']);
        Estado::create(['descricao' => 'Minas Gerais', 'codigo_interno' => 31, 'pais_id' => 30, 'sigla' => 'MG']);
        Estado::create(['descricao' => 'Espírito Santo', 'codigo_interno' => 32, 'pais_id' => 30, 'sigla' => 'ES']);
        Estado::create(['descricao' => 'Rio de Janeiro', 'codigo_interno' => 33, 'pais_id' => 30, 'sigla' => 'RJ']);
        Estado::create(['descricao' => 'São Paulo', 'codigo_interno' => 35, 'pais_id' => 30, 'sigla' => 'SP']);
        Estado::create(['descricao' => 'Paraná', 'codigo_interno' => 41, 'pais_id' => 30, 'sigla' => 'PR']);
        Estado::create(['descricao' => 'Santa Catarina', 'codigo_interno' => 42, 'pais_id' => 30, 'sigla' => 'SC']);
        Estado::create(['descricao' => 'Rio Grande do Sul', 'codigo_interno' => 43, 'pais_id' => 30, 'sigla' => 'RS']);
        Estado::create(['descricao' => 'Mato Grosso do Sul', 'codigo_interno' => 50, 'pais_id' => 30, 'sigla' => 'MS']);
        Estado::create(['descricao' => 'Mato Grosso', 'codigo_interno' => 51, 'pais_id' => 30, 'sigla' => 'MT']);
        Estado::create(['descricao' => 'Goiás', 'codigo_interno' => 52, 'pais_id' => 30, 'sigla' => 'GO']);
        Estado::create(['descricao' => 'Distrito Federal', 'codigo_interno' => 53, 'pais_id' => 30, 'sigla' => 'DF']);
    }
}

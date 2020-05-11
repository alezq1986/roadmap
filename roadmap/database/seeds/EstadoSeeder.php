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
        $e1 = Estado::create(['descricao' => 'Rondônia', 'codigo_interno' => 11, 'pais_id' => 30, 'sigla' => 'RO']);
        $e2 = Estado::create(['descricao' => 'Acre', 'codigo_interno' => 12, 'pais_id' => 30, 'sigla' => 'AC']);
        $e3 = Estado::create(['descricao' => 'Amazonas', 'codigo_interno' => 13, 'pais_id' => 30, 'sigla' => 'AM']);
        $e4 = Estado::create(['descricao' => 'Roraima', 'codigo_interno' => 14, 'pais_id' => 30, 'sigla' => 'RR']);
        $e5 = Estado::create(['descricao' => 'Pará', 'codigo_interno' => 15, 'pais_id' => 30, 'sigla' => 'PA']);
        $e6 = Estado::create(['descricao' => 'Amapá', 'codigo_interno' => 16, 'pais_id' => 30, 'sigla' => 'AP']);
        $e7 = Estado::create(['descricao' => 'Tocantins', 'codigo_interno' => 17, 'pais_id' => 30, 'sigla' => 'TO']);
        $e8 = Estado::create(['descricao' => 'Maranhão', 'codigo_interno' => 21, 'pais_id' => 30, 'sigla' => 'MA']);
        $e9 = Estado::create(['descricao' => 'Piauí', 'codigo_interno' => 22, 'pais_id' => 30, 'sigla' => 'PI']);
        $e10 = Estado::create(['descricao' => 'Ceará', 'codigo_interno' => 23, 'pais_id' => 30, 'sigla' => 'CE']);
        $e11 = Estado::create(['descricao' => 'Rio Grande do Norte', 'codigo_interno' => 24, 'pais_id' => 30, 'sigla' => 'RN']);
        $e12 = Estado::create(['descricao' => 'Paraíba', 'codigo_interno' => 25, 'pais_id' => 30, 'sigla' => 'PB']);
        $e13 = Estado::create(['descricao' => 'Pernambuco', 'codigo_interno' => 26, 'pais_id' => 30, 'sigla' => 'PE']);
        $e14 = Estado::create(['descricao' => 'Alagoas', 'codigo_interno' => 27, 'pais_id' => 30, 'sigla' => 'AL']);
        $e15 = Estado::create(['descricao' => 'Sergipe', 'codigo_interno' => 28, 'pais_id' => 30, 'sigla' => 'SE']);
        $e16 = Estado::create(['descricao' => 'Bahia', 'codigo_interno' => 29, 'pais_id' => 30, 'sigla' => 'BA']);
        $e17 = Estado::create(['descricao' => 'Minas Gerais', 'codigo_interno' => 31, 'pais_id' => 30, 'sigla' => 'MG']);
        $e18 = Estado::create(['descricao' => 'Espírito Santo', 'codigo_interno' => 32, 'pais_id' => 30, 'sigla' => 'ES']);
        $e19 = Estado::create(['descricao' => 'Rio de Janeiro', 'codigo_interno' => 33, 'pais_id' => 30, 'sigla' => 'RJ']);
        $e20 = Estado::create(['descricao' => 'São Paulo', 'codigo_interno' => 35, 'pais_id' => 30, 'sigla' => 'SP']);
        $e21 = Estado::create(['descricao' => 'Paraná', 'codigo_interno' => 41, 'pais_id' => 30, 'sigla' => 'PR']);
        $e22 = Estado::create(['descricao' => 'Santa Catarina', 'codigo_interno' => 42, 'pais_id' => 30, 'sigla' => 'SC']);
        $e23 = Estado::create(['descricao' => 'Rio Grande do Sul', 'codigo_interno' => 43, 'pais_id' => 30, 'sigla' => 'RS']);
        $e24 = Estado::create(['descricao' => 'Mato Grosso do Sul', 'codigo_interno' => 50, 'pais_id' => 30, 'sigla' => 'MS']);
        $e25 = Estado::create(['descricao' => 'Mato Grosso', 'codigo_interno' => 51, 'pais_id' => 30, 'sigla' => 'MT']);
        $e26 = Estado::create(['descricao' => 'Goiás', 'codigo_interno' => 52, 'pais_id' => 30, 'sigla' => 'GO']);
        $e27 = Estado::create(['descricao' => 'Distrito Federal', 'codigo_interno' => 53, 'pais_id' => 30, 'sigla' => 'DF']);
    }
}

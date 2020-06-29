<?php

use App\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::update(DB::raw('truncate table clientes restart identity cascade'));

        Cliente::create(['nome' => 'Torra Torra']);
        Cliente::create(['nome' => 'Atacadão Dia a Dia']);
        Cliente::create(['nome' => 'Grupo Alvorada']);
        Cliente::create(['nome' => 'Rappi']);
        Cliente::create(['nome' => 'Copacol']);
        Cliente::create(['nome' => 'Ferragens Negrão']);
        Cliente::create(['nome' => 'CresceVendas']);
        Cliente::create(['nome' => 'Angeloni']);
        Cliente::create(['nome' => 'Carone']);
        Cliente::create(['nome' => 'Comper']);
        Cliente::create(['nome' => 'Petz']);
        Cliente::create(['nome' => 'Roldão']);
        Cliente::create(['nome' => 'São José']);
        Cliente::create(['nome' => 'Nestlé']);
        Cliente::create(['nome' => 'Decathlon']);
        Cliente::create(['nome' => 'Vianense']);
        Cliente::create(['nome' => 'Lojas Mel']);
        Cliente::create(['nome' => 'Caedu']);
        Cliente::create(['nome' => 'ASP Supermercados']);
        Cliente::create(['nome' => 'Supermercado Club de Campo']);
        Cliente::create(['nome' => 'Irmãos Lopes']);
        Cliente::create(['nome' => 'Mercafácil']);
        Cliente::create(['nome' => 'Makro Atacadista']);
        Cliente::create(['nome' => 'Tenda Atacado']);
        Cliente::create(['nome' => 'Troco Simples']);
        Cliente::create(['nome' => 'St Marche']);
        Cliente::create(['nome' => 'Cassol Centerlar']);
        Cliente::create(['nome' => 'Sumerbol Supermercados']);
        Cliente::create(['nome' => 'Eskala']);
        Cliente::create(['nome' => 'Bistek']);
        Cliente::create(['nome' => 'Ases Distribuidora']);
        Cliente::create(['nome' => 'DFA']);
        Cliente::create(['nome' => 'Cacau Noir']);
        Cliente::create(['nome' => 'CIS Eletrônica']);
        Cliente::create(['nome' => 'Sephora']);
        Cliente::create(['nome' => 'Soupet']);
        Cliente::create(['nome' => 'Kidzania']);
        Cliente::create(['nome' => 'Formosa']);
        Cliente::create(['nome' => 'Supermercado Agricer']);
        Cliente::create(['nome' => 'Hiper Mais Atacado']);
        Cliente::create(['nome' => 'Santo Supermercados']);
        Cliente::create(['nome' => 'Perim Supermercados']);
        Cliente::create(['nome' => 'Bauducco']);
        Cliente::create(['nome' => 'Vivara']);
        Cliente::create(['nome' => 'Coasul']);
        Cliente::create(['nome' => 'Cooperouro']);
        Cliente::create(['nome' => 'MCassab']);
        Cliente::create(['nome' => 'Casa do Lojista']);
        Cliente::create(['nome' => 'Autoglass']);
        Cliente::create(['nome' => 'Atacado dos Presentes']);
        Cliente::create(['nome' => 'Palomax']);
        Cliente::create(['nome' => 'Beira Mar']);
        Cliente::create(['nome' => 'Nazaré']);
        Cliente::create(['nome' => 'Papadog']);
        Cliente::create(['nome' => 'Atacado Máximo']);
        Cliente::create(['nome' => 'Adyen']);
        Cliente::create(['nome' => 'Comercial Gerdau']);
        Cliente::create(['nome' => 'Koga-Koga']);
        Cliente::create(['nome' => 'Supermercado Jacomar']);
        Cliente::create(['nome' => 'Sonda Supermercados']);
        Cliente::create(['nome' => 'Indigo']);
        Cliente::create(['nome' => 'Cocatrel']);
        Cliente::create(['nome' => 'Sacolão Assunção']);
        Cliente::create(['nome' => 'Beleza Natural']);
        Cliente::create(['nome' => 'Benjamin a Padaria']);
        Cliente::create(['nome' => 'Moderna']);
        Cliente::create(['nome' => 'Ourinhos']);
        Cliente::create(['nome' => 'Ibope DTM']);
        Cliente::create(['nome' => 'Mundo Pet']);
        Cliente::create(['nome' => 'Cobasi']);
        Cliente::create(['nome' => 'Mart Minas']);
        Cliente::create(['nome' => 'Copagril']);
        Cliente::create(['nome' => 'Paulinas']);
        Cliente::create(['nome' => 'Taco Modas']);
        Cliente::create(['nome' => 'Modelo Supermercado']);
        Cliente::create(['nome' => 'OSID']);
        Cliente::create(['nome' => 'Big Atibaia']);
        Cliente::create(['nome' => 'DMCard']);
        Cliente::create(['nome' => 'Payface']);
        Cliente::create(['nome' => 'Delaware']);
        Cliente::create(['nome' => 'Hippo Supermercados']);
        Cliente::create(['nome' => 'Frigorífico BB']);
        Cliente::create(['nome' => 'Propz']);
        Cliente::create(['nome' => 'Heineken']);
        Cliente::create(['nome' => 'Lojas Emmanulle']);
        Cliente::create(['nome' => 'Soneda']);
        Cliente::create(['nome' => 'Hiper Dal Pozzo']);
        Cliente::create(['nome' => 'Da Praça Supermercado']);
        Cliente::create(['nome' => 'Abeve']);
        Cliente::create(['nome' => 'Wickbold']);
        Cliente::create(['nome' => 'Dibs']);
        Cliente::create(['nome' => 'VoxCred']);
        Cliente::create(['nome' => 'AME Digital']);
        Cliente::create(['nome' => 'BitSoftware']);
        Cliente::create(['nome' => 'Scanntech']);
        Cliente::create(['nome' => 'Sorocred']);


    }
}

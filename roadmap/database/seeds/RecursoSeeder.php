<?php

use App\Recurso;
use Illuminate\Database\Seeder;

class RecursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::update(DB::raw('truncate table recursos restart identity cascade'));

        Recurso::create(['nome' => 'Francinei Lima', 'data_inicio' => '2019-12-16', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Cynara Ribeiro', 'data_inicio' => '2019-11-18', 'data_fim' => '2020-6-30']);
        Recurso::create(['nome' => 'João Ricardo Mendonça', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Ana Carla', 'data_inicio' => '2019-12-23', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Jackson Fischer', 'data_inicio' => '2019-1-1', 'data_fim' => '2020-04-30']);
        Recurso::create(['nome' => 'Daniel Nakagawa', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Bit 1', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Bit 2', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Bit 3', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Bit 4', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Bruno Silva', 'data_inicio' => '2019-8-19', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Bit 5', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Joaquim Souza', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Marcelo Martins', 'data_inicio' => '2019-1-1', 'data_fim' => '2020-03-31']);
        Recurso::create(['nome' => 'Jucie Andrade', 'data_inicio' => '2019-12-9', 'data_fim' => '2020-03-31']);
        Recurso::create(['nome' => 'José Netto', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Marco Antonio', 'data_inicio' => '2020-1-6', 'data_fim' => '2020-04-30']);
        Recurso::create(['nome' => 'Robson Oliveira', 'data_inicio' => '2020-3-2', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Raduan Mendes', 'data_inicio' => '2020-3-2', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Fernando Silva', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Éber Lincoln', 'data_inicio' => '2019-11-18', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Celso Freitas', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Nalva Souza', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Hugo Caldeira', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Henrique Oliveira', 'data_inicio' => '2019-10-20', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Jessica Machado', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Celia Souza', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Luiz Souza', 'data_inicio' => '2020-3-2', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Patricia Mello', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Diego Santos', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Tairo Miguel', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Nivaldo Nery', 'data_inicio' => '2019-1-1', 'data_fim' => '2019-12-31']);
        Recurso::create(['nome' => 'Carla Amaral', 'data_inicio' => '2019-1-1', 'data_fim' => '2019-12-31']);
        Recurso::create(['nome' => 'Cristina Canhadas', 'data_inicio' => '2019-1-1', 'data_fim' => '2019-12-31']);
        Recurso::create(['nome' => 'Denise Cabeceira', 'data_inicio' => '2019-1-1', 'data_fim' => '2019-12-31']);
        Recurso::create(['nome' => 'Vladir Junior', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Onei Alves', 'data_inicio' => '2019-1-1', 'data_fim' => '2019-12-31']);
        Recurso::create(['nome' => 'Stratus A1', 'data_inicio' => '2019-1-1', 'data_fim' => '2019-12-31']);
        Recurso::create(['nome' => 'João Rezende', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Alexandre Queiroz', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Denilson Tose', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Walace Soares', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Aleson França', 'data_inicio' => '2019-1-1', 'data_fim' => '2019-12-31']);
        Recurso::create(['nome' => 'Caio Florio', 'data_inicio' => '2019-1-1', 'data_fim' => '2019-12-31']);
        Recurso::create(['nome' => 'Marcelo Junior', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Alexandre Filho', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Stratus D1', 'data_inicio' => '2019-1-1', 'data_fim' => '2019-12-31']);
        Recurso::create(['nome' => 'CD2', 'data_inicio' => '2019-1-1', 'data_fim' => '2020-12-31']);
        Recurso::create(['nome' => 'Leandro Tolentino', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Marcio Bonizi', 'data_inicio' => '2019-1-1', 'data_fim' => '2019-12-31']);
        Recurso::create(['nome' => 'Javier Leon', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Joaquim Salles', 'data_inicio' => '2019-1-1', 'data_fim' => '2019-12-31']);
        Recurso::create(['nome' => 'Alan Silva', 'data_inicio' => '2019-1-1', 'data_fim' => '2019-12-31']);
        Recurso::create(['nome' => 'Denilson Souza', 'data_inicio' => '2019-1-1', 'data_fim' => '2019-12-31']);
        Recurso::create(['nome' => 'Daniel Duarte', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Denis Melo', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Augusto Rodrigues', 'data_inicio' => '2020-5-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Pedro Marques', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Rafael Candido', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Hector Carneiro', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Guilherme Sousa', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Consultoria Zanthus', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Elvys Janusz', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Tarcisio Fernandes', 'data_inicio' => '2019-1-1', 'data_fim' => '2019-12-31']);
        Recurso::create(['nome' => 'Marcio Santos', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Stratus T1', 'data_inicio' => '2019-1-1', 'data_fim' => '2019-12-31']);
        Recurso::create(['nome' => 'Bruno Neuman', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Gean Almeida', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Stratus M1', 'data_inicio' => '2019-1-1', 'data_fim' => '2019-12-31']);
        Recurso::create(['nome' => 'Vinicius Nascimento', 'data_inicio' => '2019-1-1', 'data_fim' => '2025-12-31']);
        Recurso::create(['nome' => 'Henrique Souza', 'data_inicio' => '2019-12-31', 'data_fim' => '2025-12-31']);
    }
}

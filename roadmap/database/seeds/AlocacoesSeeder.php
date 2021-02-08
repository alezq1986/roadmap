<?php

use Illuminate\Database\Seeder;
use App\Alocacao;

class AlocacoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::update(DB::raw('truncate table alocacoes restart identity cascade'));

        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 288, 'data_inicio_proj' => '2019-4-1', 'data_fim_proj' => '2019-5-31', 'recurso_id' => 38]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 289, 'data_inicio_proj' => '2019-6-3', 'data_fim_proj' => '2020-6-2', 'recurso_id' => 47]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 290, 'data_inicio_proj' => '2020-7-17', 'data_fim_proj' => '2020-10-23', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 291, 'data_inicio_proj' => '2019-6-3', 'data_fim_proj' => '2020-6-2', 'recurso_id' => 47]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 292, 'data_inicio_proj' => '2020-7-17', 'data_fim_proj' => '2021-1-25', 'recurso_id' => 31]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 293, 'data_inicio_proj' => '2021-1-18', 'data_fim_proj' => '2021-1-29', 'recurso_id' => 66]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 294, 'data_inicio_proj' => '2021-2-1', 'data_fim_proj' => '2021-2-5', 'recurso_id' => 66]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 903, 'data_inicio_proj' => '2020-11-6', 'data_fim_proj' => '2020-11-20', 'recurso_id' => 28]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 904, 'data_inicio_proj' => '2020-12-16', 'data_fim_proj' => '2021-1-12', 'recurso_id' => 79]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 905, 'data_inicio_proj' => '2021-1-18', 'data_fim_proj' => '2021-1-18', 'recurso_id' => 22]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 906, 'data_inicio_proj' => '2020-12-8', 'data_fim_proj' => '2021-1-11', 'recurso_id' => 8]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 907, 'data_inicio_proj' => '2021-1-18', 'data_fim_proj' => '2021-1-18', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 908, 'data_inicio_proj' => '2021-1-18', 'data_fim_proj' => '2021-1-29', 'recurso_id' => 80]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 909, 'data_inicio_proj' => '2021-2-1', 'data_fim_proj' => '2021-2-2', 'recurso_id' => 80]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 450, 'data_inicio_proj' => '2020-3-27', 'data_fim_proj' => '2020-9-10', 'recurso_id' => 4]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 451, 'data_inicio_proj' => '2020-12-18', 'data_fim_proj' => '2021-1-28', 'recurso_id' => 7]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 452, 'data_inicio_proj' => '2021-1-29', 'data_fim_proj' => '2021-1-29', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 453, 'data_inicio_proj' => '2020-12-18', 'data_fim_proj' => '2021-1-28', 'recurso_id' => 16]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 454, 'data_inicio_proj' => '2021-1-29', 'data_fim_proj' => '2021-1-29', 'recurso_id' => 22]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 455, 'data_inicio_proj' => '2021-1-29', 'data_fim_proj' => '2021-2-11', 'recurso_id' => 81]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 456, 'data_inicio_proj' => '2021-2-12', 'data_fim_proj' => '2021-2-18', 'recurso_id' => 81]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 910, 'data_inicio_proj' => '2020-9-3', 'data_fim_proj' => '2020-9-11', 'recurso_id' => 4]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 911, 'data_inicio_proj' => '2020-9-14', 'data_fim_proj' => '2020-9-15', 'recurso_id' => 22]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 912, 'data_inicio_proj' => '2020-10-5', 'data_fim_proj' => '2020-10-5', 'recurso_id' => 22]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 913, 'data_inicio_proj' => '2020-12-28', 'data_fim_proj' => '2021-1-8', 'recurso_id' => 48]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 914, 'data_inicio_proj' => '2021-1-19', 'data_fim_proj' => '2021-1-19', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 915, 'data_inicio_proj' => '2021-1-18', 'data_fim_proj' => '2021-1-22', 'recurso_id' => 27]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 916, 'data_inicio_proj' => '2021-1-25', 'data_fim_proj' => '2021-1-25', 'recurso_id' => 27]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 313, 'data_inicio_proj' => '2019-2-4', 'data_fim_proj' => '2019-3-1', 'recurso_id' => 3]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 314, 'data_inicio_proj' => '2019-3-6', 'data_fim_proj' => '2021-2-5', 'recurso_id' => 21]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 315, 'data_inicio_proj' => '2019-6-2', 'data_fim_proj' => '2019-8-7', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 316, 'data_inicio_proj' => '2021-2-8', 'data_fim_proj' => '2021-2-12', 'recurso_id' => 23]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 317, 'data_inicio_proj' => '2021-2-15', 'data_fim_proj' => '2021-2-19', 'recurso_id' => 23]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 741, 'data_inicio_proj' => '2020-11-9', 'data_fim_proj' => '2020-11-24', 'recurso_id' => 75]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 742, 'data_inicio_proj' => '2021-1-18', 'data_fim_proj' => '2021-2-5', 'recurso_id' => 79]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 743, 'data_inicio_proj' => '2021-2-8', 'data_fim_proj' => '2021-2-8', 'recurso_id' => 22]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 744, 'data_inicio_proj' => '2021-2-22', 'data_fim_proj' => '2021-3-4', 'recurso_id' => 23]);
#N/D
#N/D
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 917, 'data_inicio_proj' => '2020-12-28', 'data_fim_proj' => '2021-1-21', 'recurso_id' => 4]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 918, 'data_inicio_proj' => '2021-1-22', 'data_fim_proj' => '2021-2-8', 'recurso_id' => 8]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 919, 'data_inicio_proj' => '2021-2-9', 'data_fim_proj' => '2021-2-9', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 920, 'data_inicio_proj' => '2021-1-22', 'data_fim_proj' => '2021-2-9', 'recurso_id' => 18]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 921, 'data_inicio_proj' => '2021-2-10', 'data_fim_proj' => '2021-2-10', 'recurso_id' => 22]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 922, 'data_inicio_proj' => '2021-2-10', 'data_fim_proj' => '2021-2-12', 'recurso_id' => 80]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 923, 'data_inicio_proj' => '2021-2-15', 'data_fim_proj' => '2021-2-15', 'recurso_id' => 80]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 924, 'data_inicio_proj' => '2020-12-3', 'data_fim_proj' => '2020-12-11', 'recurso_id' => 82]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 925, 'data_inicio_proj' => '2020-12-14', 'data_fim_proj' => '2020-12-29', 'recurso_id' => 18]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 926, 'data_inicio_proj' => '2021-1-18', 'data_fim_proj' => '2021-1-18', 'recurso_id' => 55]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 927, 'data_inicio_proj' => '2020-12-30', 'data_fim_proj' => '2021-1-13', 'recurso_id' => 82]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 661, 'data_inicio_proj' => '2021-1-18', 'data_fim_proj' => '2021-1-22', 'recurso_id' => 75]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 662, 'data_inicio_proj' => '2021-1-29', 'data_fim_proj' => '2021-2-16', 'recurso_id' => 7]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 663, 'data_inicio_proj' => '2021-2-17', 'data_fim_proj' => '2021-2-17', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 664, 'data_inicio_proj' => '2021-1-29', 'data_fim_proj' => '2021-2-16', 'recurso_id' => 16]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 665, 'data_inicio_proj' => '2021-2-17', 'data_fim_proj' => '2021-2-18', 'recurso_id' => 22]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 666, 'data_inicio_proj' => '2021-2-17', 'data_fim_proj' => '2021-3-2', 'recurso_id' => 80]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 667, 'data_inicio_proj' => '2021-3-5', 'data_fim_proj' => '2021-3-9', 'recurso_id' => 23]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 928, 'data_inicio_proj' => '2021-1-18', 'data_fim_proj' => '2021-1-22', 'recurso_id' => 26]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 929, 'data_inicio_proj' => '2021-1-25', 'data_fim_proj' => '2021-2-5', 'recurso_id' => 48]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 930, 'data_inicio_proj' => '2021-2-8', 'data_fim_proj' => '2021-2-8', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 931, 'data_inicio_proj' => '2021-2-8', 'data_fim_proj' => '2021-2-19', 'recurso_id' => 79]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 932, 'data_inicio_proj' => '2021-2-22', 'data_fim_proj' => '2021-2-22', 'recurso_id' => 22]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 933, 'data_inicio_proj' => '2021-2-22', 'data_fim_proj' => '2021-3-5', 'recurso_id' => 81]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 934, 'data_inicio_proj' => '2021-3-8', 'data_fim_proj' => '2021-3-9', 'recurso_id' => 80]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 426, 'data_inicio_proj' => '2020-4-14', 'data_fim_proj' => '2020-4-17', 'recurso_id' => 2]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 427, 'data_inicio_proj' => '2021-2-10', 'data_fim_proj' => '2021-2-23', 'recurso_id' => 18]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 428, 'data_inicio_proj' => '2021-3-8', 'data_fim_proj' => '2021-3-12', 'recurso_id' => 81]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 935, 'data_inicio_proj' => '2021-1-18', 'data_fim_proj' => '2021-1-26', 'recurso_id' => 82]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 936, 'data_inicio_proj' => '2021-2-24', 'data_fim_proj' => '2021-3-26', 'recurso_id' => 18]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 937, 'data_inicio_proj' => '2021-3-29', 'data_fim_proj' => '2021-3-30', 'recurso_id' => 22]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 938, 'data_inicio_proj' => '2021-2-8', 'data_fim_proj' => '2021-2-9', 'recurso_id' => 48]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 939, 'data_inicio_proj' => '2021-3-29', 'data_fim_proj' => '2021-4-9', 'recurso_id' => 74]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 940, 'data_inicio_proj' => '2021-4-12', 'data_fim_proj' => '2021-4-14', 'recurso_id' => 74]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 941, 'data_inicio_proj' => '2021-1-18', 'data_fim_proj' => '2021-1-20', 'recurso_id' => 28]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 942, 'data_inicio_proj' => '2021-1-21', 'data_fim_proj' => '2021-1-27', 'recurso_id' => 19]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 943, 'data_inicio_proj' => '2021-1-28', 'data_fim_proj' => '2021-1-28', 'recurso_id' => 22]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 944, 'data_inicio_proj' => '2021-1-21', 'data_fim_proj' => '2021-2-15', 'recurso_id' => 83]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 945, 'data_inicio_proj' => '2021-2-18', 'data_fim_proj' => '2021-2-19', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 946, 'data_inicio_proj' => '2021-2-16', 'data_fim_proj' => '2021-3-3', 'recurso_id' => 3]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 947, 'data_inicio_proj' => '2021-3-4', 'data_fim_proj' => '2021-3-5', 'recurso_id' => 3]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 948, 'data_inicio_proj' => '2020-10-19', 'data_fim_proj' => '2021-1-4', 'recurso_id' => 28]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 949, 'data_inicio_proj' => '2020-11-16', 'data_fim_proj' => '2021-1-11', 'recurso_id' => 83]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 950, 'data_inicio_proj' => '2021-1-20', 'data_fim_proj' => '2021-1-20', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 951, 'data_inicio_proj' => '2020-11-25', 'data_fim_proj' => '2021-1-19', 'recurso_id' => 19]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 952, 'data_inicio_proj' => '2021-1-20', 'data_fim_proj' => '2021-1-21', 'recurso_id' => 22]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 953, 'data_inicio_proj' => '2021-1-20', 'data_fim_proj' => '2021-2-5', 'recurso_id' => 3]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 954, 'data_inicio_proj' => '2021-2-8', 'data_fim_proj' => '2021-2-10', 'recurso_id' => 3]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 955, 'data_inicio_proj' => '2021-1-22', 'data_fim_proj' => '2021-1-27', 'recurso_id' => 4]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 956, 'data_inicio_proj' => '2021-1-28', 'data_fim_proj' => '2021-2-8', 'recurso_id' => 6]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 957, 'data_inicio_proj' => '2021-2-10', 'data_fim_proj' => '2021-2-10', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 958, 'data_inicio_proj' => '2021-1-28', 'data_fim_proj' => '2021-2-8', 'recurso_id' => 19]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 959, 'data_inicio_proj' => '2021-2-9', 'data_fim_proj' => '2021-2-9', 'recurso_id' => 22]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 960, 'data_inicio_proj' => '2021-2-9', 'data_fim_proj' => '2021-2-17', 'recurso_id' => 27]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 961, 'data_inicio_proj' => '2021-2-18', 'data_fim_proj' => '2021-2-19', 'recurso_id' => 27]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 962, 'data_inicio_proj' => '2021-1-27', 'data_fim_proj' => '2021-2-2', 'recurso_id' => 82]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 963, 'data_inicio_proj' => '2021-2-3', 'data_fim_proj' => '2021-2-26', 'recurso_id' => 10]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 964, 'data_inicio_proj' => '2021-3-1', 'data_fim_proj' => '2021-3-2', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 965, 'data_inicio_proj' => '2021-3-10', 'data_fim_proj' => '2021-3-23', 'recurso_id' => 80]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 966, 'data_inicio_proj' => '2021-3-24', 'data_fim_proj' => '2021-3-26', 'recurso_id' => 23]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 967, 'data_inicio_proj' => '2021-1-28', 'data_fim_proj' => '2021-1-29', 'recurso_id' => 4]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 968, 'data_inicio_proj' => '2021-2-22', 'data_fim_proj' => '2021-2-23', 'recurso_id' => 79]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 969, 'data_inicio_proj' => '2021-2-24', 'data_fim_proj' => '2021-2-24', 'recurso_id' => 22]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 970, 'data_inicio_proj' => '2021-3-3', 'data_fim_proj' => '2021-3-4', 'recurso_id' => 80]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 971, 'data_inicio_proj' => '2021-1-21', 'data_fim_proj' => '2021-1-25', 'recurso_id' => 28]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 972, 'data_inicio_proj' => '2021-2-9', 'data_fim_proj' => '2021-2-17', 'recurso_id' => 8]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 973, 'data_inicio_proj' => '2021-2-22', 'data_fim_proj' => '2021-2-22', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 974, 'data_inicio_proj' => '2021-2-24', 'data_fim_proj' => '2021-3-4', 'recurso_id' => 79]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 975, 'data_inicio_proj' => '2021-3-5', 'data_fim_proj' => '2021-3-5', 'recurso_id' => 22]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 976, 'data_inicio_proj' => '2021-3-10', 'data_fim_proj' => '2021-3-15', 'recurso_id' => 23]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 977, 'data_inicio_proj' => '2021-3-16', 'data_fim_proj' => '2021-3-16', 'recurso_id' => 23]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 978, 'data_inicio_proj' => '2021-2-1', 'data_fim_proj' => '2021-2-1', 'recurso_id' => 4]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 979, 'data_inicio_proj' => '2021-2-10', 'data_fim_proj' => '2021-2-11', 'recurso_id' => 48]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 980, 'data_inicio_proj' => '2021-2-12', 'data_fim_proj' => '2021-2-12', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 981, 'data_inicio_proj' => '2021-3-24', 'data_fim_proj' => '2021-3-29', 'recurso_id' => 80]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 982, 'data_inicio_proj' => '2021-3-30', 'data_fim_proj' => '2021-3-30', 'recurso_id' => 80]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 983, 'data_inicio_proj' => '2021-1-26', 'data_fim_proj' => '2021-1-28', 'recurso_id' => 28]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 984, 'data_inicio_proj' => '2021-2-12', 'data_fim_proj' => '2021-2-18', 'recurso_id' => 48]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 985, 'data_inicio_proj' => '2021-2-23', 'data_fim_proj' => '2021-2-23', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 986, 'data_inicio_proj' => '2021-3-15', 'data_fim_proj' => '2021-3-19', 'recurso_id' => 81]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 987, 'data_inicio_proj' => '2021-3-22', 'data_fim_proj' => '2021-3-22', 'recurso_id' => 23]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 757, 'data_inicio_proj' => '2021-1-25', 'data_fim_proj' => '2021-2-5', 'recurso_id' => 75]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 758, 'data_inicio_proj' => '2021-2-17', 'data_fim_proj' => '2021-3-16', 'recurso_id' => 7]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 759, 'data_inicio_proj' => '2021-3-17', 'data_fim_proj' => '2021-3-18', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 760, 'data_inicio_proj' => '2021-3-31', 'data_fim_proj' => '2021-4-6', 'recurso_id' => 80]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 761, 'data_inicio_proj' => '2021-4-7', 'data_fim_proj' => '2021-4-13', 'recurso_id' => 80]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 988, 'data_inicio_proj' => '2021-2-8', 'data_fim_proj' => '2021-2-8', 'recurso_id' => 75]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 989, 'data_inicio_proj' => '2021-3-17', 'data_fim_proj' => '2021-3-30', 'recurso_id' => 7]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 990, 'data_inicio_proj' => '2021-3-31', 'data_fim_proj' => '2021-3-31', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 991, 'data_inicio_proj' => '2021-3-31', 'data_fim_proj' => '2021-4-6', 'recurso_id' => 81]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 992, 'data_inicio_proj' => '2021-4-7', 'data_fim_proj' => '2021-4-7', 'recurso_id' => 23]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 613, 'data_inicio_proj' => '2021-2-9', 'data_fim_proj' => '2021-2-11', 'recurso_id' => 75]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 614, 'data_inicio_proj' => '2021-3-31', 'data_fim_proj' => '2021-4-13', 'recurso_id' => 7]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 615, 'data_inicio_proj' => '2021-4-14', 'data_fim_proj' => '2021-4-14', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 616, 'data_inicio_proj' => '2021-3-29', 'data_fim_proj' => '2021-4-19', 'recurso_id' => 18]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 617, 'data_inicio_proj' => '2021-4-20', 'data_fim_proj' => '2021-4-21', 'recurso_id' => 22]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 618, 'data_inicio_proj' => '2021-4-20', 'data_fim_proj' => '2021-4-28', 'recurso_id' => 23]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 619, 'data_inicio_proj' => '2021-4-29', 'data_fim_proj' => '2021-4-30', 'recurso_id' => 23]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 993, 'data_inicio_proj' => '2021-2-12', 'data_fim_proj' => '2021-2-17', 'recurso_id' => 75]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 994, 'data_inicio_proj' => '2021-2-18', 'data_fim_proj' => '2021-2-24', 'recurso_id' => 8]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 995, 'data_inicio_proj' => '2021-2-25', 'data_fim_proj' => '2021-2-25', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 996, 'data_inicio_proj' => '2021-2-18', 'data_fim_proj' => '2021-2-23', 'recurso_id' => 16]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 997, 'data_inicio_proj' => '2021-2-25', 'data_fim_proj' => '2021-2-25', 'recurso_id' => 22]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 998, 'data_inicio_proj' => '2021-4-14', 'data_fim_proj' => '2021-4-21', 'recurso_id' => 80]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 999, 'data_inicio_proj' => '2021-5-3', 'data_fim_proj' => '2021-5-3', 'recurso_id' => 23]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1000, 'data_inicio_proj' => '2021-1-29', 'data_fim_proj' => '2021-2-2', 'recurso_id' => 28]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1001, 'data_inicio_proj' => '2021-3-5', 'data_fim_proj' => '2021-3-16', 'recurso_id' => 79]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1002, 'data_inicio_proj' => '2021-3-17', 'data_fim_proj' => '2021-3-17', 'recurso_id' => 22]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1003, 'data_inicio_proj' => '2021-4-22', 'data_fim_proj' => '2021-4-28', 'recurso_id' => 80]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1004, 'data_inicio_proj' => '2021-2-2', 'data_fim_proj' => '2021-2-4', 'recurso_id' => 4]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1005, 'data_inicio_proj' => '2021-2-24', 'data_fim_proj' => '2021-3-2', 'recurso_id' => 16]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1006, 'data_inicio_proj' => '2021-3-3', 'data_fim_proj' => '2021-3-3', 'recurso_id' => 22]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1007, 'data_inicio_proj' => '2021-3-22', 'data_fim_proj' => '2021-3-25', 'recurso_id' => 81]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1008, 'data_inicio_proj' => '2021-2-5', 'data_fim_proj' => '2021-2-12', 'recurso_id' => 4]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1009, 'data_inicio_proj' => '2021-2-19', 'data_fim_proj' => '2021-3-12', 'recurso_id' => 48]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1010, 'data_inicio_proj' => '2021-3-15', 'data_fim_proj' => '2021-3-15', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1011, 'data_inicio_proj' => '2021-3-3', 'data_fim_proj' => '2021-3-18', 'recurso_id' => 16]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1012, 'data_inicio_proj' => '2021-3-19', 'data_fim_proj' => '2021-3-19', 'recurso_id' => 55]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1013, 'data_inicio_proj' => '2021-5-4', 'data_fim_proj' => '2021-5-17', 'recurso_id' => 23]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1014, 'data_inicio_proj' => '2021-5-18', 'data_fim_proj' => '2021-5-19', 'recurso_id' => 23]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1015, 'data_inicio_proj' => '2021-1-18', 'data_fim_proj' => '2021-1-19', 'recurso_id' => 40]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1016, 'data_inicio_proj' => '2021-1-20', 'data_fim_proj' => '2021-1-29', 'recurso_id' => 46]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1017, 'data_inicio_proj' => '2021-2-1', 'data_fim_proj' => '2021-2-1', 'recurso_id' => 46]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1018, 'data_inicio_proj' => '2021-1-20', 'data_fim_proj' => '2021-1-26', 'recurso_id' => 84]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1019, 'data_inicio_proj' => '2021-1-27', 'data_fim_proj' => '2021-1-27', 'recurso_id' => 31]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1020, 'data_inicio_proj' => '2021-2-1', 'data_fim_proj' => '2021-2-1', 'recurso_id' => 23]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1021, 'data_inicio_proj' => '2021-2-2', 'data_fim_proj' => '2021-2-2', 'recurso_id' => 23]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1022, 'data_inicio_proj' => '2021-1-25', 'data_fim_proj' => '2021-2-5', 'recurso_id' => 26]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1023, 'data_inicio_proj' => '2021-2-25', 'data_fim_proj' => '2021-5-5', 'recurso_id' => 8]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1024, 'data_inicio_proj' => '2021-5-6', 'data_fim_proj' => '2021-5-10', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1025, 'data_inicio_proj' => '2021-3-17', 'data_fim_proj' => '2021-8-25', 'recurso_id' => 79]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1026, 'data_inicio_proj' => '2021-8-26', 'data_fim_proj' => '2021-9-1', 'recurso_id' => 22]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1027, 'data_inicio_proj' => '2021-8-26', 'data_fim_proj' => '2021-10-6', 'recurso_id' => 23]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 1028, 'data_inicio_proj' => '2021-10-7', 'data_fim_proj' => '2021-10-13', 'recurso_id' => 23]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 340, 'data_inicio_proj' => '2019-2-20', 'data_fim_proj' => '2019-3-22', 'recurso_id' => 35]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 341, 'data_inicio_proj' => '2019-3-25', 'data_fim_proj' => '2019-6-4', 'recurso_id' => 6]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 342, 'data_inicio_proj' => '2019-5-21', 'data_fim_proj' => '2019-6-4', 'recurso_id' => 20]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 343, 'data_inicio_proj' => '2019-5-23', 'data_fim_proj' => '2021-3-10', 'recurso_id' => 27]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 344, 'data_inicio_proj' => '2021-3-11', 'data_fim_proj' => '2021-4-7', 'recurso_id' => 27]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 345, 'data_inicio_proj' => '2021-1-18', 'data_fim_proj' => '2021-2-26', 'recurso_id' => 77]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 346, 'data_inicio_proj' => '2021-3-1', 'data_fim_proj' => '2021-3-2', 'recurso_id' => 20]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 347, 'data_inicio_proj' => '2021-3-1', 'data_fim_proj' => '2021-3-5', 'recurso_id' => 24]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 348, 'data_inicio_proj' => '2021-3-8', 'data_fim_proj' => '2021-3-12', 'recurso_id' => 24]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 349, 'data_inicio_proj' => '2019-1-7', 'data_fim_proj' => '2019-1-11', 'recurso_id' => 24]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 350, 'data_inicio_proj' => '2019-1-14', 'data_fim_proj' => '2019-4-19', 'recurso_id' => 30]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 351, 'data_inicio_proj' => '2019-4-22', 'data_fim_proj' => '2019-4-26', 'recurso_id' => 20]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 352, 'data_inicio_proj' => '2019-4-29', 'data_fim_proj' => '2021-7-2', 'recurso_id' => 24]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 353, 'data_inicio_proj' => '2021-7-5', 'data_fim_proj' => '2021-7-9', 'recurso_id' => 24]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 411, 'data_inicio_proj' => '2018-12-21', 'data_fim_proj' => '2021-7-29', 'recurso_id' => 31]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 412, 'data_inicio_proj' => '2021-7-30', 'data_fim_proj' => '2021-8-3', 'recurso_id' => 31]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 413, 'data_inicio_proj' => '2021-7-30', 'data_fim_proj' => '2021-8-12', 'recurso_id' => 23]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 414, 'data_inicio_proj' => '2021-8-13', 'data_fim_proj' => '2021-8-19', 'recurso_id' => 23]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 464, 'data_inicio_proj' => '2019-1-2', 'data_fim_proj' => '2019-1-8', 'recurso_id' => 23]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 465, 'data_inicio_proj' => '2019-1-9', 'data_fim_proj' => '2019-2-5', 'recurso_id' => 50]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 466, 'data_inicio_proj' => '2019-2-6', 'data_fim_proj' => '2020-5-8', 'recurso_id' => 22]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 467, 'data_inicio_proj' => '2019-9-10', 'data_fim_proj' => '2020-6-3', 'recurso_id' => 62]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 468, 'data_inicio_proj' => '2021-1-15', 'data_fim_proj' => '2021-1-18', 'recurso_id' => 23]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 649, 'data_inicio_proj' => '2021-2-3', 'data_fim_proj' => '2021-2-16', 'recurso_id' => 28]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 650, 'data_inicio_proj' => '2021-3-1', 'data_fim_proj' => '2021-4-9', 'recurso_id' => 10]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 651, 'data_inicio_proj' => '2021-4-12', 'data_fim_proj' => '2021-4-13', 'recurso_id' => 45]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 652, 'data_inicio_proj' => '2021-3-19', 'data_fim_proj' => '2021-4-15', 'recurso_id' => 16]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 653, 'data_inicio_proj' => '2021-4-16', 'data_fim_proj' => '2021-4-19', 'recurso_id' => 22]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 654, 'data_inicio_proj' => '2021-4-29', 'data_fim_proj' => '2021-5-5', 'recurso_id' => 80]);
        Alocacao::create(['roadmap_id' => 1, 'atividade_id' => 655, 'data_inicio_proj' => '2021-5-20', 'data_fim_proj' => '2021-5-26', 'recurso_id' => 23]);

    }
}

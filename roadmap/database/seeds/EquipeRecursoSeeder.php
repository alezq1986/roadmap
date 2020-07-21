<?php

use Illuminate\Database\Seeder;

class EquipeRecursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::update(DB::raw('truncate table equipe_recurso restart identity cascade'));

        DB::table('equipe_recurso')->insert(['recurso_id' => 1, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 2, 'equipe_id' => 2]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 3, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 4, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 4, 'equipe_id' => 2]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 5, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 6, 'equipe_id' => 2]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 7, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 8, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 9, 'equipe_id' => 2]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 10, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 11, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 12, 'equipe_id' => 4]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 13, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 13, 'equipe_id' => 2]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 13, 'equipe_id' => 5]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 14, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 15, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 16, 'equipe_id' => 6]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 17, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 18, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 18, 'equipe_id' => 2]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 18, 'equipe_id' => 5]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 19, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 19, 'equipe_id' => 2]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 19, 'equipe_id' => 5]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 20, 'equipe_id' => 3]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 20, 'equipe_id' => 4]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 21, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 22, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 22, 'equipe_id' => 2]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 22, 'equipe_id' => 3]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 22, 'equipe_id' => 4]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 22, 'equipe_id' => 5]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 22, 'equipe_id' => 6]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 23, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 23, 'equipe_id' => 5]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 24, 'equipe_id' => 3]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 25, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 25, 'equipe_id' => 5]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 26, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 27, 'equipe_id' => 2]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 28, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 29, 'equipe_id' => 4]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 30, 'equipe_id' => 4]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 31, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 31, 'equipe_id' => 2]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 31, 'equipe_id' => 3]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 31, 'equipe_id' => 4]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 31, 'equipe_id' => 5]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 31, 'equipe_id' => 6]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 32, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 33, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 34, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 35, 'equipe_id' => 2]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 36, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 37, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 38, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 39, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 40, 'equipe_id' => 5]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 41, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 42, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 43, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 44, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 45, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 45, 'equipe_id' => 2]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 45, 'equipe_id' => 6]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 46, 'equipe_id' => 5]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 47, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 48, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 49, 'equipe_id' => 5]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 50, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 51, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 52, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 53, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 54, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 55, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 55, 'equipe_id' => 2]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 55, 'equipe_id' => 3]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 55, 'equipe_id' => 4]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 55, 'equipe_id' => 5]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 55, 'equipe_id' => 6]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 56, 'equipe_id' => 4]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 57, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 57, 'equipe_id' => 2]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 57, 'equipe_id' => 5]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 58, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 59, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 60, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 61, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 62, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 63, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 64, 'equipe_id' => 2]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 65, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 66, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 67, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 68, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 68, 'equipe_id' => 2]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 68, 'equipe_id' => 3]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 68, 'equipe_id' => 4]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 68, 'equipe_id' => 5]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 68, 'equipe_id' => 6]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 69, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 70, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 71, 'equipe_id' => 4]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 72, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 73, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 74, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 75, 'equipe_id' => 1]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 76, 'equipe_id' => 6]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 77, 'equipe_id' => 3]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 77, 'equipe_id' => 4]);
        DB::table('equipe_recurso')->insert(['recurso_id' => 78, 'equipe_id' => 6]);

    }
}

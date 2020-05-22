<?php

use Illuminate\Database\Seeder;

class CompetenciaRecursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::update(DB::raw('truncate table competencia_recurso restart identity cascade'));

        DB::table('competencia_recurso')->insert(['recurso_id' => 1, 'competencia_id' => 4, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 2, 'competencia_id' => 4, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 3, 'competencia_id' => 4, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 4, 'competencia_id' => 4, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 5, 'competencia_id' => 1, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 6, 'competencia_id' => 1, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 7, 'competencia_id' => 1, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 8, 'competencia_id' => 1, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 9, 'competencia_id' => 1, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 10, 'competencia_id' => 1, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 11, 'competencia_id' => 1, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 12, 'competencia_id' => 1, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 13, 'competencia_id' => 2, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 14, 'competencia_id' => 2, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 15, 'competencia_id' => 2, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 16, 'competencia_id' => 2, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 17, 'competencia_id' => 2, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 18, 'competencia_id' => 2, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 19, 'competencia_id' => 2, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 20, 'competencia_id' => 6, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 21, 'competencia_id' => 6, 'permite_aloc_automatica' => 0]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 22, 'competencia_id' => 7, 'permite_aloc_automatica' => 1], ['recurso_id' => 22, 'competencia_id' => 2, 'permite_aloc_automatica' => 0]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 23, 'competencia_id' => 5, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 24, 'competencia_id' => 5, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 25, 'competencia_id' => 5, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 26, 'competencia_id' => 5, 'permite_aloc_automatica' => 0]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 27, 'competencia_id' => 5, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 28, 'competencia_id' => 5, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 29, 'competencia_id' => 4, 'permite_aloc_automatica' => 0]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 30, 'competencia_id' => 1, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 31, 'competencia_id' => 8, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 32, 'competencia_id' => 5, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 33, 'competencia_id' => 4, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 34, 'competencia_id' => 4, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 35, 'competencia_id' => 4, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 36, 'competencia_id' => 4, 'permite_aloc_automatica' => 0]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 37, 'competencia_id' => 5, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 38, 'competencia_id' => 4, 'permite_aloc_automatica' => 0]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 39, 'competencia_id' => 5, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 40, 'competencia_id' => 4, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 41, 'competencia_id' => 5, 'permite_aloc_automatica' => 0]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 42, 'competencia_id' => 1, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 43, 'competencia_id' => 1, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 44, 'competencia_id' => 1, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 45, 'competencia_id' => 6, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 46, 'competencia_id' => 1, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 47, 'competencia_id' => 1, 'permite_aloc_automatica' => 0]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 48, 'competencia_id' => 1, 'permite_aloc_automatica' => 0]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 49, 'competencia_id' => 1, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 50, 'competencia_id' => 2, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 51, 'competencia_id' => 2, 'permite_aloc_automatica' => 0]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 52, 'competencia_id' => 2, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 53, 'competencia_id' => 2, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 54, 'competencia_id' => 2, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 55, 'competencia_id' => 2, 'permite_aloc_automatica' => 0]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 56, 'competencia_id' => 2, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 57, 'competencia_id' => 2, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 58, 'competencia_id' => 5, 'permite_aloc_automatica' => 0]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 59, 'competencia_id' => 5, 'permite_aloc_automatica' => 0]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 60, 'competencia_id' => 5, 'permite_aloc_automatica' => 0]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 61, 'competencia_id' => 5, 'permite_aloc_automatica' => 0]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 62, 'competencia_id' => 5, 'permite_aloc_automatica' => 0]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 63, 'competencia_id' => 5, 'permite_aloc_automatica' => 0]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 64, 'competencia_id' => 5, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 65, 'competencia_id' => 5, 'permite_aloc_automatica' => 0]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 66, 'competencia_id' => 5, 'permite_aloc_automatica' => 0]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 67, 'competencia_id' => 5, 'permite_aloc_automatica' => 0]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 68, 'competencia_id' => 3, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 69, 'competencia_id' => 3, 'permite_aloc_automatica' => 0]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 46, 'competencia_id' => 6, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 70, 'competencia_id' => 1, 'permite_aloc_automatica' => 1]);
        DB::table('competencia_recurso')->insert(['recurso_id' => 71, 'competencia_id' => 5, 'permite_aloc_automatica' => 1]);
    }
}

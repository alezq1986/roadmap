<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RecursoSeeder::class);
        $this->call(EquipeSeeder::class);
        $this->call(CompetenciaSeeder::class);
        $this->call(CompetenciaRecursoSeeder::class);
        $this->call(EquipeRecursoSeeder::class);
        $this->call(RoadmapSeeder::class);
        $this->call(ProjetoSeeder::class);
        $this->call(ProjetoRoadmapSeeder::class);
        $this->call(AtividadeSeeder::class);
        $this->call(AtividadeDependenciaSeeder::class);
        $this->call(AlocacoesSeeder::class);
        $this->call(PaisSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(MunicipioSeeder::class);
        $this->call(FeriadoSeeder::class);
        $this->call(BloqueioSeeder::class);
        $this->call(ParametroSeeder::class);
    }
}

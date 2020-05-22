<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class alocarRoadmap implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $roadmap;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($roadmap)
    {
        $this->roadmap = $roadmap;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $atividades = $this->roadmap->atividades();

        foreach ($atividades as $atividade) {

            $continuar = (parse_ini_file(storage_path('alocar.ini')))['continuar'];

            if ($continuar == 1) {

                $atividade->alocarAtividade($this);
            } else {

                break;
            }
        }

        $this->roadmap->alocado = 1;

        $this->roadmap->save();
    }
}

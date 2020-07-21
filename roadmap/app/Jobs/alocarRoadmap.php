<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $this->roadmap->alocado = 1;

        $this->roadmap->save();

        try {

            $alocacao = $this->roadmap->alocar();

        } catch (\Exception $e) {

            $this->roadmap->alocado = 0;

            $this->roadmap->save();

            Log::error('alocarRoadmap', ['roadmap' => $this->roadmap->id, 'erro' => $e]);

        }


        if (!$alocacao) {

            $this->roadmap->alocado = 2;

            $this->roadmap->save();
        }

    }
}

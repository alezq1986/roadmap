<?php

namespace App;

use App\Pais;
use App\Estado;
use App\Municipio;
use Illuminate\Database\Eloquent\Model;

class Feriado extends Model
{
    protected $fillable = ['descricao', 'data', 'entidade_id', 'entidade_tipo'];

    public function entidades()
    {
        return $this->morphTo();
    }

    public static function feriadosPorLocal($local)
    {
        $feriados = collect();

        if ($local instanceof Pais) {
            foreach ($local->feriados as $feriado) {
                $feriados->push($feriado);
            }

        } elseif ($local instanceof Estado) {
            foreach ($local->pais->feriados as $feriado) {
                $feriados->push($feriado);
            }
            foreach ($local->feriados as $feriado) {
                $feriados->push($feriado);
            }
        } elseif ($local instanceof Municipio) {
            foreach ($local->pais->feriados as $feriado) {
                $feriados->push($feriado);
            }
            foreach ($local->estado->feriados as $feriado) {
                $feriados->push($feriado);
            }
            foreach ($local->feriados as $feriado) {
                $feriados->push($feriado);
            }
        }
        return $feriados;
    }
}

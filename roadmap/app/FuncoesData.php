<?php

namespace App;

use App\Feriado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class FuncoesData extends Model
{
    /**
     * @param $data
     * @param Collection $feriados
     * @param int $formato : 0 - string, 1 - time
     * @return int
     */
    public static function ehDiaUtil($data, Collection $feriados, $formato = 0)
    {

        if (!$formato) {
            $data = strtotime($data);

            $feriados->map(function ($feriado, $key) {
                $feriado->data = strtotime($feriado->data);
            });
        }
        return ($feriados->contains('data', $data) || date("N", $data) >= 6) ? 0 : 1;
    }

    public static function ehDiaLivre($data, Collection $feriados, Collection $datas_indisponiveis, $formato = 0)
    {


        if (!$formato) {
            $data = strtotime($data);

            $feriados->map(function ($feriado) {
                $feriado->data = strtotime($feriado->data);
            });
        }

        $livre = 1;

        if (date("N", $data) >= 6) {

            $livre = 0;

            return $livre;
        }


        if ($feriados->contains('data', $data)) {

            $livre = 0;

            return $livre;
        }

        foreach ($datas_indisponiveis as $data_indisponivel) {

            if ($data >= $data_indisponivel->data_inicio && $data <= $data_indisponivel->data_fim) {

                $livre = 0;

                return $livre;
            }
        }
        return $livre;
    }
}

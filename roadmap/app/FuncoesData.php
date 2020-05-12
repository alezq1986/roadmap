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
     * @return int
     */
    public static function ehDiaUtil($data, Collection $feriados)
    {
        if (!is_integer($data)) {
            $data = strtotime($data);
        }


        $feriados->map(function ($feriado) {

            if (!is_integer($feriado->data)) {
                $feriado->data = strtotime($feriado->data);
            }

        });

        return ($feriados->contains('data', $data) || date("N", $data) >= 6) ? 0 : 1;
    }

    /**
     * @param $data
     * @param Collection $feriados
     * @param Collection $datas_indisponiveis
     * @return int
     */
    public static function ehDiaLivre($data, Collection $feriados, Collection $datas_indisponiveis)
    {
        if (!is_integer($data)) {
            $data = strtotime($data);
        }

        $feriados->map(function ($feriado) {

            if (!is_integer($feriado->data)) {
                $feriado->data = strtotime($feriado->data);
            }

        });

        $datas_indisponiveis = $datas_indisponiveis->map(function ($data_indisponivel, $key) {

            if (!is_integer($data_indisponivel['data_inicio'])) {
                $data_inicio = strtotime($data_indisponivel['data_inicio']);
            } else {
                $data_inicio = $data_indisponivel['data_inicio'];
            }

            if (!is_integer($data_indisponivel['data_fim'])) {
                $data_fim = strtotime($data_indisponivel['data_fim']);
            } else {
                $data_fim = $data_indisponivel['data_fim'];
            }
            return ['data_inicio' => $data_inicio, 'data_fim' => $data_fim];
        });

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

            if ($data >= $data_indisponivel['data_inicio'] && $data <= $data_indisponivel['data_fim']) {

                $livre = 0;

                return $livre;
            }
        }

        return $livre;
    }

    /**
     * @param $data
     * @param $dias
     * @param Collection $feriados
     * @return false|string
     */
    public static function moverDiaUtil($data, $dias, Collection $feriados)
    {
        if (!is_integer($data)) {
            $data = strtotime($data);
        }

        $feriados->map(function ($feriado) {

            if (!is_integer($feriado->data)) {
                $feriado->data = strtotime($feriado->data);
            }

        });

        $falta_mover = $dias;

        while ($dias != 0 && $falta_mover != 0) {

            $data = $data + ($dias > 0 ? 86400 : -86400);

            if (self::ehDiaUtil($data, $feriados) == 1) {

                $dias > 0 ? $falta_mover-- : $falta_mover++;

            }

        }

        return date('Y-m-d', $data);
    }
}


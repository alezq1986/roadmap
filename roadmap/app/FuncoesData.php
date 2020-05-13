<?php

namespace App;

use App\Feriado;
use App\Municipio;
use App\Parametro;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class FuncoesData extends Model
{
    /**
     * @param $data
     * @param Collection $feriados
     * @return int
     */
    public static function ehDiaUtil($data, Collection $feriados = null)
    {
        if (is_null($feriados)) {
            $municipio_padrao = Parametro::where('codigo', '=', 1)->first();

            $municipio = Municipio::find($municipio_padrao->valor);

            $feriados = Feriado::feriadosPorLocal($municipio);
        }

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
    public static function ehDiaLivre($data, Collection $datas_indisponiveis, Collection $feriados = null)
    {
        if (is_null($feriados)) {
            $municipio_padrao = Parametro::where('codigo', '=', 1)->first();

            $municipio = Municipio::find($municipio_padrao->valor);

            $feriados = Feriado::feriadosPorLocal($municipio);
        }

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
    public static function moverDiaUtil($data, $dias, Collection $feriados = null)
    {
        if (is_null($feriados)) {
            $municipio_padrao = Parametro::where('codigo', '=', 1)->first();

            $municipio = Municipio::find($municipio_padrao->valor);

            $feriados = Feriado::feriadosPorLocal($municipio);
        }

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

    /**
     * @param $data_inicio
     * @param $data_fim
     * @param int $modo : 0 - dias corridos, 1 - exclui fins de semana, 2 - exclui fins de semana e feriados, 3 - exclui fins de semana, feriados e datas indisponíveis
     * @param int $extremos : 0 - considerar dia inicial e final, 1 - considerar apenas dia inicial, 2 - considerar apenas dia final, 3 - não considera nem dia inicial nem final
     * @param Collection $datas_indisponiveis
     * @param Collection $feriados
     * @return float|int
     */
    public static function calcularDias($data_inicio, $data_fim, $modo = 0, $extremos = 0, Collection $datas_indisponiveis, Collection $feriados = null)
    {
        if (is_null($feriados)) {
            $municipio_padrao = Parametro::where('codigo', '=', 1)->first();

            $municipio = Municipio::find($municipio_padrao->valor);

            $feriados = Feriado::feriadosPorLocal($municipio);
        }

        if (!is_integer($data_inicio)) {
            $data_inicio = strtotime($data_inicio);
        }

        if (!is_integer($data_fim)) {
            $data_fim = strtotime($data_fim);
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

        switch ($extremos) {
            case 0:

                break;

            case 1:

                $data_fim = $data_fim - 86400;

                break;

            case 2:

                $data_inicio = $data_inicio + 86400;

                break;

            case 3:

                $data_fim = $data_fim - 86400;

                $data_inicio = $data_inicio + 86400;

                break;

            default:
        }

        $dias_corridos = ($data_fim - $data_inicio) / 86400 + 1;

        $dias_fds = 0;

        $dias_feriados = 0;

        if ($modo == 1 || $modo == 2 || $modo == 3) {
            $semanas_cheias = intdiv($dias_corridos, 7);

            $resto = $dias_corridos % 7;

            $dias_fds = 2 * $semanas_cheias;

            if (date("N", $data_inicio) == 1) {
                $dia_da_semana_final = 7;

            } else {

                $dia_da_semana_final = date("N", $data_inicio) - 1;

            }

            if ($dia_da_semana_final + $resto >= 6) {
                $dias_fds++;
            }

            if ($dia_da_semana_final + $resto >= 7) {

                $dias_fds++;

            }

        }

        if ($modo == 2 || $modo == 3) {
            foreach ($feriados as $feriado) {
                if ($feriado->data >= $data_inicio && $feriado->data <= $data_fim && date("N", $feriado->data) < 6) {
                    $dias_feriados++;
                }
            }
        }

        $dias_indisponiveis = 0;

        if ($modo == 3) {
            foreach ($datas_indisponiveis as $data_indisponivel) {
                $dias_indisponiveis = +max(FuncoesData::calcularDias(max($data_indisponivel['data_inicio'], $data_inicio), min($data_indisponivel['data_fim'], $data_fim), $modo, 0, $c = collect(), $feriados), 0);
            }
        }

        $dias = $dias_corridos - $dias_fds - $dias_feriados - $dias_indisponiveis;

        return $dias;
    }

    /**
     * @param $data_inicio
     * @param $prazo
     * @param Collection $datas_indisponiveis
     * @param Collection $feriados
     * @return false|string
     */
    public static function calcularDataFim($data_inicio, $prazo, Collection $datas_indisponiveis, Collection $feriados = null)
    {
        if (is_null($feriados)) {
            $municipio_padrao = Parametro::where('codigo', '=', 1)->first();

            $municipio = Municipio::find($municipio_padrao->valor);

            $feriados = Feriado::feriadosPorLocal($municipio);
        }

        if (!is_integer($data_inicio)) {
            $data_inicio = strtotime($data_inicio);
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

        while (self::ehDiaLivre($data_inicio, $feriados, $datas_indisponiveis) == 0) {
            $data_inicio = $data_inicio + 86400;
        }

        $data_fim = $data_inicio;

        $falta_mover = $prazo - 1;

        while ($prazo != 0 && $falta_mover != 0) {
            $data_fim = $data_fim + 86400;

            if (self::ehDiaLivre($data_fim, $feriados, $datas_indisponiveis) == 1) {
                $falta_mover--;
            }

        }

        return date('Y-m-d', $data_fim);

    }

}



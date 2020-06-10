<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FuncoesApoio extends Model
{
    public static function calcularDesvioPadrao($arr)
    {
        $elementos = count($arr);

        $var = 0.0;

        $media = array_sum($arr) / $elementos;

        foreach ($arr as $i) {

            $var += pow(($i - $media), 2);
        }

        return (float)sqrt($var / $elementos);
    }

    public static function removerOutliers($arr, $limite)
    {
        $elementos = count($arr);

        $var = 0.0;

        $media = array_sum($arr) / $elementos;

        foreach ($arr as $i) {

            $var += pow(($i - $media), 2);
        }

        $dp = sqrt($var / $elementos);

        $filtrada = array_filter($arr, function ($a) use ($media, $limite) {

            return ($a >= $media - $limite * $dp && $a <= $media + $limite * $dp);

        });

        return ['dados' => $filtrada, 'dp' => $dp];

    }

}

<?php

/** @var Factory $factory */

use App\Recurso;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Recurso::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'data_inicio' => $faker->date(),
        'data_fim' => $faker->date(),
    ];
});

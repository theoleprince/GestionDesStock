<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Magasin;
use Faker\Generator as Faker;

$factory->define(Magasin::class, function (Faker $faker) {
    return [
        'nom_magasin' => $faker->sentence(),
        'description' => $faker->sentence(),
        //'capacite' => $faker->numberBetween(0,100),
    ];
});

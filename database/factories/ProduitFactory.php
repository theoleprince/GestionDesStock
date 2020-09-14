<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Produit;
use Faker\Generator as Faker;

$factory->define(Produit::class, function (Faker $faker) {
    return [
        'nom_produit' => $faker->sentence(),
        'description' => $faker->sentence(),
        'prix' => $faker->numberBetween(0,100),
        'quantite' => $faker->numberBetween(0,100),
        'photo' => "upload/image.png",
    ];
});

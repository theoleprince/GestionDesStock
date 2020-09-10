<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Categorie;
use Faker\Generator as Faker;

$factory->define(Categorie::class, function (Faker $faker) {
    return [
        'nom_categorie' => $faker->sentence(),
        'description' => $faker->sentence(),
        //'name' => $faker->unique()->name,
       // 'photo' => "upload/image.png",
        //'rencontre' => $faker->paragraph(),
        //'dateCreation' => $faker->date(),
    ];
});

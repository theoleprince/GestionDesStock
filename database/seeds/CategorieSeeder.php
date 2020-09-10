<?php

use App\Categorie;
use Illuminate\Database\Seeder;
//use DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(\Faker\Generator $faker)
    {
        factory(Categorie::class, 100)->make()->each(function ($categorie) use ($faker) {
            //$categorie = App\categorie::all();
            //$categorie->type_id = $faker->randomElement($categorie)->id;
            $categorie->save();
           
        });
    }
}

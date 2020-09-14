<?php

use App\Magasin;
use Illuminate\Database\Seeder;
//use DB;

class MagasinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(\Faker\Generator $faker)
    {
        factory(Magasin::class, 100)->make()->each(function ($magasin) use ($faker) {
           // $types = App\NomModel::all();
            //$categorie->type_id = $faker->randomElement($types)->id;
            $magasin->save();
           
        });
    }
}

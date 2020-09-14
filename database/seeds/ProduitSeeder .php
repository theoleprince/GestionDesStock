<?php

use App\Produit;
use Illuminate\Database\Seeder;
//use DB;

class ProduitSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(\Faker\Generator $faker)
    {
        factory(Produit::class, 100)->make()->each(function ($produit) use ($faker) {
            $categorie = App\Categorie::all();
            $produit->id_categorie = $faker->randomElement($categorie)->id;
            $produit->save();
           
        });
    }
}

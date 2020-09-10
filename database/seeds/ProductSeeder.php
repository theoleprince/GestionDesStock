<?php
use App\Produit;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(\Faker\Generator $faker)
    {
        factory(Produit::class, 100)->make()->each(function ($produit) use ($faker) {
             $types = App\Categorie::all();
             $produit->id_categorie = $faker->randomElement($types)->id;
             $produit->save();
        });
    }
}

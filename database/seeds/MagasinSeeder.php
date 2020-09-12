<?php

use Illuminate\Database\Seeder;
use App\Magasin;

class MagasinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(\Faker\Generator $faker)
    {
        factory(Magasin::class, 100)->make()->each(function ($Magasin) use ($faker) {
            $Magasin->save();
           
        });
    }
}

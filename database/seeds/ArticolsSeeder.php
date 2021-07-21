<?php
use App\Articol;
use Illuminate\Database\Seeder;
use Faker\Generator as faker;

class ArticolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) { 
            $articol = new Articol();
            $articol->name = $faker->word();
            $articol->description = $faker->paragraph();
            $articol->date = $faker->dateTime();
            $articol->save();
        }
    }
}

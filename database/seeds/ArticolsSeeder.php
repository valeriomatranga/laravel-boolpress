<?php
use App\Articol;
use Illuminate\Database\Seeder;
use Faker\Generator as faker;
use Illuminate\Support\Str;


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
            $articol->image = $faker->imageUrl(300, 300, 'Posts', true, $articol->title);
            $articol->name = $faker->word();
            $articol->description = $faker->paragraph();
            $articol->save();
        }
    }
}

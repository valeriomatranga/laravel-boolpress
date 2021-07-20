<?php
use App\Blog;
//use Facade\Ignition\Support\FakeComposer;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class blogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) { 
            $blog = new Blog();
            $blog->name = $faker->word();
            $blog->description = $faker->paragraphs();
            $blog->date = $faker->dateTime();
            $blog->save();
        }
    }
}

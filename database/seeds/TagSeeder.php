<?php

use App\Tag;
use Illuminate\Database\Seeder;
use PhpParser\Node\Stmt\Foreach_;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['HTML','CSS','Botstrap','JavaScript','VueJs','PHP','Laravel'];
        
        foreach ($tags as $SingolTag) {
            $tag = new $SingolTag();
            $tag->name = $SingolTag;
            $tag->slug = str::slug($SingolTag);
            $tag->save();
        }
    }

}

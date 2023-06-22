<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Tag;

class PostsTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    for ($i=0; $i <50 ; $i++) {
    //estraggo un post random ad ogni ciclo, post e' il punto di partenza
    $post = Post::inRandomOrder()->first();
    //estraggp  l 'id di un tag random , quindi di tag prendo solo l'id
    $tag_id = Tag::inRandomOrder()->first()->id;

    //- PER SCRIVERE NELLA TABELLA PONTE USO ATTACH, in questo caso uso post come punto di partenza ma sarebbe potuto essere tag
    //siccome uso post il metodo dentro post e' tags
    //attacco a tutto il post post l'id di tag

    $post->tags()->attach($tag_id);





        # code...
    }
    }
}
<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
    for ($i=0;$i <100 ; $i++) {
    $new_post = new Post();
    $new_post->category_id = Category::inRandomOrder()->first()->id;
    $new_post->title = $faker->sentence();
    $new_post->slug = Post::generateSlug($new_post->title);
    $new_post->text = $faker->text(1000);
    $new_post->date = $faker->date('Y-m-d');
    $new_post->save();


    }

    }
}
<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $data = ['Front End', 'Back End', 'Design', 'UX', 'Laravel', 'VueJs'];
    foreach($data as $tag){
    $new_tag = new Tag();
    $new_tag->name=$tag;
    $new_tag->slug = Str::slug($tag , '-');
    $new_tag->save();
    }
    }
}

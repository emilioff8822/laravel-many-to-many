<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $data = ['HTML', 'CSS', 'JavaScript', 'PHP', 'C++'];
    foreach($data as $category){
    $new_category = new Category();
    $new_category->name=$category;
    $new_category->slug = Str::slug($category);
    $new_category->save();
    }


    }
}
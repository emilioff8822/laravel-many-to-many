<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
                    CategoryTableSeeder::class,
                    TagsTableSeeder::class,

                    PostsTableSeeder::class //in produzione commentare questo seeder

    ]);
    }
}
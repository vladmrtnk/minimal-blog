<?php

namespace Database\Seeders;

use App\Models\Blog\Post;
use Database\Seeders\Blog\CategoryTableSeeder;
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
        $this->call(UserTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        Post::factory(100)->create();
    }
}

<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];
        $categoryName = 'Без категорії';
        $dateTime = Carbon::now();

        $categories[] = [
            'title'      => $categoryName,
            'slug'       => Str::slug($categoryName),
            'parent_id'  => 0,
            'created_at' => $dateTime,
            'updated_at' => $dateTime,
        ];

        for ($i = 2; $i <= 11; $i++) {
            $categoryName = 'Категорія ' . $i;
            $parentId = ($i > 4) ? rand(1, 4) : 1;

            $categories[] = [
                'title'      => $categoryName,
                'slug'       => Str::slug($categoryName),
                'parent_id'  => $parentId,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ];
        }

        DB::table('blog_categories')->insert($categories);
    }
}

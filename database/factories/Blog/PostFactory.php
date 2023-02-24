<?php

namespace Database\Factories\Blog;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence(rand(3, 8));
        $text = $this->faker->realText(rand(1000, 4000));
        $isPublished = rand(1, 5) > 1;
        $createdAt = $this->faker->dateTimeBetween('-3 months', '-2 days');

        return [
            'category_id'  => rand(1, 11),
            'user_id'      => (rand(1, 5) == 5) ? 1 : 2,
            'title'        => $title,
            'slug'         => Str::slug($title),
            'excerpt'      => $this->faker->text(rand(40, 100)),
//            'content_raw'  => $text,
//            'content_html' => $text,
            'content' => $text,
            'is_published' => $isPublished,
            'published_at' => $isPublished ? $this->faker->dateTimeBetween('-2 months','-1 days')
                : null,
            'created_at'   => $createdAt,
            'updated_at'   => $createdAt
        ];
    }
}

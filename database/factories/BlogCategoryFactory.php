<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogCategory>
 */
class BlogCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->catchPhrase;
        return [
            'title'       => $title,
            'slug'        => Str::slug($title),
            'parent_id'   => rand(1, 10),
            'description' => $this->faker->text(50),
        ];
    }
}

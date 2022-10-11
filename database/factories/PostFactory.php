<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
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
        return [
            'title' => Str::title($title = fake()->name()),
            'slug' => Str::slug($title),
            'content' => fake()->text(500),
            'public_at' => now()->addMinutes(rand(0, 200)),
        ];
    }
}

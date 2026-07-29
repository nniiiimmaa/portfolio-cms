<?php

namespace Database\Factories;

use App\Models\Hobby;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Hobby>
 */
class HobbyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Photography',
            'Gaming',
            'Reading',
            'Travel',
            'Cooking',
            'Music',
            'Drawing',
            'Cycling',
        ]);

        return [
            'slug' => Str::slug($name),
            'icon' => null,
            'featured' => fake()->boolean(30),
            'order' => fake()->numberBetween(1, 20),
        ];
    }
}

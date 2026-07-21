<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_logo' => null,
            'photo' => null,
            'rating' => fake()->numberBetween(4, 5),
            'approved' => fake()->boolean(90),
            'featured' => fake()->boolean(30),
            'order' => fake()->numberBetween(1, 20),
        ];
    }
}

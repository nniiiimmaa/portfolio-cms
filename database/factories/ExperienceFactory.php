<?php

namespace Database\Factories;

use App\Models\Experience;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company' => fake()->company(),
            'logo' => null,
            'location' => fake()->city() . ', ' . fake()->country(),
            'start_date' => fake()->dateTimeBetween('-10 years', '-2 years'),
            'end_date' => fake()->boolean(30)
                ? null
                : fake()->dateTimeBetween('-2 years', 'now'),
            'current' => fake()->boolean(30),
            'technologies' => fake()->randomElements([
                'Vue',
                'Laravel',
                'Docker',
                'Tailwind CSS',
                'JavaScript',
                'TypeScript',
                'PHP',
                'MySQL',
            ], fake()->numberBetween(2, 5)),
            'order' => fake()->numberBetween(1, 20),
        ];
    }
}

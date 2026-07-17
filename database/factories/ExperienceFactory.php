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
            'position' => fake()->randomElement([
                'Front-End Developer',
                'Full Stack Developer',
                'Software Engineer',
                'Web Developer',
                'Vue.js Developer',
            ]),
            'location' => fake()->city() . ', ' . fake()->country(),
            'description' => fake()->paragraph(3),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'is_current' => fake()->boolean(),
            'technologies' => fake()->randomElements([
                'JavaScript',
                'Vue',
                'Laravel',
                'Tailwind CSS',
                'Docker',
                'MySQL',
                'Git',
            ], 4),

        ];
    }
}

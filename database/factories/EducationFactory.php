<?php

namespace Database\Factories;

use App\Models\Education;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Education>
 */
class EducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $current = fake()->boolean(20);

        $startDate = fake()->dateTimeBetween('-8 years', '-2 years');

        $endDate = $current
            ? null
            : fake()->dateTimeBetween($startDate, 'now');

        return [
            'institution' => fake()->company(),
            'degree' => fake()->randomElement([
                'Bachelor Degree',
                'Master Degree',
                'Associate Degree',
                'Technical Degree',
                'Bootcamp',
            ]),
            'field' => fake()->randomElement([
                'Computer Science',
                'Software Engineering',
                'Information Systems',
                'Psychology',
            ]),
            'location' => fake()->city(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'score' => fake()->optional()->randomFloat(2, 6, 10),
            'description' => fake()->paragraph(),
            'logo' => null,
            'current' => $current,
            'order' => fake()->numberBetween(1, 20),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Vue.js',
            'Laravel',
            'PHP',
            'JavaScript',
            'TypeScript',
            'Tailwind CSS',
            'Docker',
            'Git',
            'MySQL',
            'SQL Server',
            'Figma',
            'Postman',
        ]);

        return [
            'skill_category_id' => SkillCategory::inRandomOrder()->value('id'),
            'slug' => Str::slug($name),
            'icon' => null,
            'level' => fake()->numberBetween(60, 100),
            'years_experience' => fake()->numberBetween(1, 6),
            'featured' => fake()->boolean(30),
            'order' => fake()->numberBetween(1, 50),
        ];
    }
}

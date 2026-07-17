<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\ProjectStatus;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_type_id' =>
                ProjectType::inRandomOrder()->value('id'),
            'project_status_id' =>
                ProjectStatus::inRandomOrder()->value('id'),
            'title' =>
                fake()->sentence(3),
            'slug' =>
                fake()->slug(),
            'description' =>
                fake()->paragraph(),
            'logo' =>
                null,
            'github_url' =>
                fake()->url(),
            'live_url' =>
                fake()->url(),
            'featured' =>
                fake()->boolean(),
            'order' =>
                fake()->numberBetween(1,10),
            'technologies' => [
                'Vue',
                'Laravel',
                'Docker',
            ],

        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\SocialLink;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SocialLink>
 */
class SocialLinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'GitHub',
                'LinkedIn',
                'Instagram',
                'X',
                'Facebook',
                'YouTube',
            ]),
            'icon' => null,
            'url' => fake()->url(),
            'username' => fake()->userName(),
            'color' => fake()->hexColor(),
            'active' => fake()->boolean(90),
            'order' => fake()->numberBetween(1, 10),
        ];
    }
}

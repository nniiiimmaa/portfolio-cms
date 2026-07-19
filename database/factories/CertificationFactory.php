<?php

namespace Database\Factories;

use App\Models\Certification;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Certification>
 */
class CertificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $issueDate = fake()->dateTimeBetween('-5 years', 'now');

        return [
            'issue_date' => $issueDate,
            'expiration_date' => fake()->optional(0.2)->dateTimeBetween('+1 year', '+4 years'),
            'credential_id' => strtoupper(Str::random(12)),
            'credential_url' => fake()->url(),
            'image' => null,
            'order' => fake()->numberBetween(1, 50),
        ];
    }
}

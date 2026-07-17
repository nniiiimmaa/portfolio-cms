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
        $title = fake()->randomElement([
            'Vue.js Complete Guide',
            'Laravel From Scratch',
            'Docker Essentials',
            'Responsive Web Design',
            'JavaScript Algorithms',
            'PHP Fundamentals',
            'Git & GitHub',
            'Modern CSS',
            'REST API Development',
            'TypeScript Basics',
        ]);

        $issuers = [
            ['name' => 'Udemy', 'country' => 'United States'],
            ['name' => 'Coursera', 'country' => 'United States'],
            ['name' => 'Meta', 'country' => 'United States'],
            ['name' => 'Google', 'country' => 'United States'],
            ['name' => 'Microsoft', 'country' => 'United States'],
            ['name' => 'Oracle', 'country' => 'United States'],
            ['name' => 'Alura', 'country' => 'Brazil'],
            ['name' => 'DIO', 'country' => 'Brazil'],
            ['name' => 'Laracasts', 'country' => 'Canada'],
        ];

        $issuer = fake()->randomElement($issuers);

        $issueDate = fake()->dateTimeBetween('-5 years', 'now');

        return [
            'title' => $title,
            'issuer_name' => $issuer['name'],
            'issuer_country' => $issuer['country'],
            'issue_date' => $issueDate,
            'expiration_date' => fake()->optional(0.2)->dateTimeBetween('+1 year', '+4 years'),
            'credential_id' => strtoupper(Str::random(12)),
            'credential_url' => fake()->url(),
            'image' => null,
            'description' => fake()->paragraph(),
            'order' => fake()->numberBetween(1, 50),
        ];
    }
}

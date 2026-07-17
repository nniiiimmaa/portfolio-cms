<?php

namespace Database\Factories;

use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ContactMessage>
 */
class ContactMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'whatsapp' => fake()->optional()->phoneNumber(),
            'company' => fake()->optional()->company(),
            'subject' => fake()->sentence(3),
            'message' => fake()->paragraphs(3, true),
            'read_at' => fake()->optional(0.5)
                ->dateTimeBetween('-30 days', 'now'),
        ];
    }
}

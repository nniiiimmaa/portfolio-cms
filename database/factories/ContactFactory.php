<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'Let\'s Work Together',
            'description' => fake()->paragraph(),
            'email' => fake()->safeEmail(),
            'whatsapp' => fake()->phoneNumber(),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'country' => fake()->country(),
            'postal_code' => fake()->postcode(),
            'google_maps_url' => fake()->url(),
            'working_hours' => 'Monday - Friday | 09:00 - 18:00',
            'available' => true,
        ];
    }
}

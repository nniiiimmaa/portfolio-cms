<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::updateOrCreate(
            ['id' => 1],
            [
                'title' => 'Let\'s Work Together',
                'description' => 'Whether you have a project, a job opportunity, or simply want to connect, feel free to reach out. I am always open to discussing new ideas and collaborations.',
                'email' => 'contact@example.com',
                'whatsapp' => '+55 (44) 99999-9999',
                'address' => 'Your Address',
                'city' => 'Maringá',
                'state' => 'Paraná',
                'country' => 'Brazil',
                'postal_code' => '87000-000',
                'google_maps_url' => 'https://maps.google.com/',
                'working_hours' => 'Monday - Friday | 09:00 - 18:00',
                'available' => true,
            ]
        );
    }
}

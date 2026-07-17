<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::updateOrCreate(
        [
            'id' => 1,
        ],    
        [
            'name' => 'Nima',
            'title' => 'Front-End Developer',
            'description' => 'I am a Front-End Developer focused on building modern, scalable, and user-centered web applications. I specialize in Vue.js, Laravel, and modern frontend technologies, creating responsive interfaces with clean architecture, maintainable code, and efficient user experiences.',
            'available' => true,
            'availability_text' => 'Open to Opportunities',
            'image' => null,
        ]);
    }
}

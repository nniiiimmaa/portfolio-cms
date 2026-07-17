<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimonial::updateOrCreate(
            [
                'name' => 'John Smith',
            ],
            [
                'position' => 'Senior Front-End Developer',
                'company' => 'Google',
                'company_logo' => null,
                'photo' => null,
                'rating' => 5,
                'message' => 'Nima consistently delivered high-quality work with excellent communication and attention to detail.',
                'approved' => true,
                'featured' => true,
                'order' => 1,
            ]
        );

        Testimonial::factory()
            ->count(8)
            ->create();
    }
}

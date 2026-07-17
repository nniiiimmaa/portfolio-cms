<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Education::updateOrCreate(

            [
                'institution' => 'Faculdade Adventista do Paraná',
            ],

            [
                'degree' => 'Bachelor Degree',
                'field' => 'Psychology',
                'location' => 'Ivatuba, Paraná, Brazil',
                'start_date' => '2022-01-01',
                'end_date' => '2026-12-31',
                'score' => null,
                'description' => 'Bachelor degree focused on Psychology, including academic research, psychological assessment, community interventions, and supervised internships.',
                'logo' => 'education/fap/logo.png',
                'current' => false,
                'order' => 1,
            ]

        );

        Education::factory()
            ->count(5)
            ->create();
    }
}

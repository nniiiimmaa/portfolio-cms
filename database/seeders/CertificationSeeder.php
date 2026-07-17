<?php

namespace Database\Seeders;

use App\Models\Certification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CertificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Certification::updateOrCreate(

            [
                'title' => 'Front-End Developer Professional Certificate',
            ],

            [
                'issuer_name' => 'Meta',
                'issuer_country' => 'United States',
                'issue_date' => '2025-01-15',
                'expiration_date' => null,
                'credential_id' => 'META-123456',
                'credential_url' => 'https://example.com/certificate',
                'image' => null,
                'description' => 'Professional certification covering HTML, CSS, JavaScript, React, and frontend development best practices.',
                'order' => 1,
            ]

        );

        Certification::factory()
            ->count(10)
            ->create();
    
    }
}

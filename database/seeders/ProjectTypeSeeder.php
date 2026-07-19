<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProjectType;

class ProjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'web-application',
            'mobile-application',
            'desktop-application',
            'api',
            'library',
            'game',
            'other',
        ];


        foreach ($types as $slug) {
            ProjectType::updateOrCreate(
                [
                    'slug' => $slug,
                ]
            );
        }
    }
}

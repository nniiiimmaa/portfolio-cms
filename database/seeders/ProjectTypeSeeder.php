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

            [
                'name' => 'Web Application',
                'slug' => 'web-application',
            ],

            [
                'name' => 'Landing Page',
                'slug' => 'landing-page',
            ],

            [
                'name' => 'Corporate System',
                'slug' => 'corporate-system',
            ],

            [
                'name' => 'Internal Platform',
                'slug' => 'internal-platform',
            ],

            [
                'name' => 'Clone',
                'slug' => 'clone',
            ],

        ];


        foreach ($types as $type) {

            ProjectType::updateOrCreate(
                [
                    'slug' => $type['slug'],
                ],
                $type
            );

        }
    }
}

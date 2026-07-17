<?php

namespace Database\Seeders;

use App\Models\ProjectStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name' => 'Live',
                'slug' => 'live',
            ],

            [
                'name' => 'GitHub',
                'slug' => 'github',
            ],

            [
                'name' => 'In Development',
                'slug' => 'development',
            ],

            [
                'name' => 'Archived',
                'slug' => 'archived',
            ],
        ];


        foreach ($statuses as $status) {

            ProjectStatus::updateOrCreate(
                [
                    'slug' => $status['slug'],
                ],

                $status
            );

        }
    }
}

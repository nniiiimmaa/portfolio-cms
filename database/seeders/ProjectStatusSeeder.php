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
            'planning',
            'in-progress',
            'completed',
            'on-hold',
            'archived',
        ];

        foreach ($statuses as $slug) {
            ProjectStatus::updateOrCreate(
                [
                    'slug' => $slug,
                ]
            );
        }
    }
}

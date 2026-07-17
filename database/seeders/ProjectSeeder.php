<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectStatus;
use App\Models\ProjectType;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::factory()
            ->count(10)
            ->create();

    }
}

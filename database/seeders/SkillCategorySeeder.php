<?php

namespace Database\Seeders;

use App\Models\SkillCategory;
use Illuminate\Database\Seeder;

class SkillCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [

            [
                'name' => 'Frontend',
                'slug' => 'frontend',
                'icon' => 'mdi-monitor-dashboard',
                'order' => 1,
            ],

            [
                'name' => 'Backend',
                'slug' => 'backend',
                'icon' => 'mdi-server',
                'order' => 2,
            ],

            [
                'name' => 'Database',
                'slug' => 'database',
                'icon' => 'mdi-database',
                'order' => 3,
            ],

            [
                'name' => 'DevOps',
                'slug' => 'devops',
                'icon' => 'mdi-docker',
                'order' => 4,
            ],

            [
                'name' => 'Tools',
                'slug' => 'tools',
                'icon' => 'mdi-tools',
                'order' => 5,
            ],

            [
                'name' => 'Design',
                'slug' => 'design',
                'icon' => 'mdi-palette',
                'order' => 6,
            ],

        ];

        foreach ($categories as $category) {

            SkillCategory::updateOrCreate(

                [
                    'slug' => $category['slug'],
                ],
                $category
            );

        }
    }
}

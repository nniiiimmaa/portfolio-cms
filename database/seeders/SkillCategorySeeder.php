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
                'slug' => 'frontend',
                'icon' => 'code',
                'order' => 1,
            ],
            [
                'slug' => 'backend',
                'icon' => 'server',
                'order' => 2,
            ],
            [
                'slug' => 'database',
                'icon' => 'database',
                'order' => 3,
            ],
            [
                'slug' => 'tools',
                'icon' => 'tool',
                'order' => 4,
            ],
            [
                'slug' => 'languages',
                'icon' => 'language',
                'order' => 5,
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

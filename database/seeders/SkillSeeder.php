<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $frontend = SkillCategory::where('slug', 'frontend')->first();

    Skill::updateOrCreate(

        [
            'slug' => 'vue-js',
        ],

        [
            'skill_category_id' => $frontend->id,
            'name' => 'Vue.js',
            'icon' => 'devicon-vuejs-plain',
            'level' => 95,
            'years_experience' => 4,
            'description' => 'Frontend framework for building modern web applications.',
            'featured' => true,
            'order' => 1,
        ]

    );

    Skill::factory()
        ->count(8)
        ->create();
    }
}

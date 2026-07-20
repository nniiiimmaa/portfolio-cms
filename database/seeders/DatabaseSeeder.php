<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
                AboutSeeder::class,
                ExperienceSeeder::class,
                ProjectTypeSeeder::class,
                ProjectStatusSeeder::class,
                ProjectSeeder::class,
                EducationSeeder::class,
                SkillCategorySeeder::class,
                SkillSeeder::class,
                CertificationSeeder::class,
                SocialLinkSeeder::class,
                TestimonialSeeder::class,
                ContactSeeder::class,
                LanguageSeeder::class,
                AboutTranslationSeeder::class,
                ExperienceTranslationSeeder::class,
                ProjectTypeTranslationSeeder::class,
                ProjectStatusTranslationSeeder::class,
                ProjectTranslationSeeder::class,
                EducationTranslationSeeder::class,
                CertificationTranslationSeeder::class,
                SkillCategoryTranslationSeeder::class,
                SkillTranslationSeeder::class,
                HobbySeeder::class,
                HobbyTranslationSeeder::class,
                TestimonialTranslationSeeder::class,
                ContactTranslationSeeder::class,
            ]);
    }
}

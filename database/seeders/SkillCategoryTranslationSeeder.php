<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\SkillCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillCategoryTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = Language::pluck('id', 'code');


        $translations = [
            'frontend' => [

                'en' => 'Frontend',
                'pt' => 'Front-end',
                'es' => 'Frontend',
                'de' => 'Frontend-Entwicklung',
                'tr' => 'Frontend Geliştirme',
                'fa' => 'فرانت‌اند',
                'ar' => 'تطوير الواجهات الأمامية',

            ],
            'backend' => [

                'en' => 'Backend',
                'pt' => 'Back-end',
                'es' => 'Backend',
                'de' => 'Backend-Entwicklung',
                'tr' => 'Backend Geliştirme',
                'fa' => 'بک‌اند',
                'ar' => 'تطوير الواجهات الخلفية',

            ],
            'database' => [

                'en' => 'Database',
                'pt' => 'Banco de Dados',
                'es' => 'Base de Datos',
                'de' => 'Datenbank',
                'tr' => 'Veritabanı',
                'fa' => 'پایگاه داده',
                'ar' => 'قواعد البيانات',

            ],
            'tools' => [

                'en' => 'Tools',
                'pt' => 'Ferramentas',
                'es' => 'Herramientas',
                'de' => 'Werkzeuge',
                'tr' => 'Araçlar',
                'fa' => 'ابزارها',
                'ar' => 'الأدوات',

            ],
            'languages' => [
                'en' => 'Languages',
                'pt' => 'Idiomas',
                'es' => 'Idiomas',
                'de' => 'Sprachen',
                'tr' => 'Diller',
                'fa' => 'زبان‌ها',
                'ar' => 'اللغات',

            ],
        ];


        foreach ($translations as $slug => $languagesData) {
            $category = SkillCategory::where(
                'slug',
                $slug
            )->first();

            if (!$category) {
                continue;
            }

            foreach ($languagesData as $code => $name) {
                $category->translations()->updateOrCreate(
                    [
                        'language_id' => $languages[$code],
                    ],
                    [
                        'name' => $name,
                    ]
                );
            }
        }
    }
}

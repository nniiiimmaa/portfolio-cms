<?php

namespace Database\Seeders;

use App\Models\Language;
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
                'slug' => 'frontend-development',
                'icon' => 'web',
                'order' => 1,
                'translations' => [
                    'en' => 'Front-End Development',
                    'pt' => 'Desenvolvimento Front-End',
                    'es' => 'Desarrollo Front-End',
                    'de' => 'Front-End-Entwicklung',
                    'tr' => 'Front-End Geliştirme',
                    'fa' => 'توسعه Front-End',
                    'ar' => 'تطوير Front-End',
                ],
            ],
            [
                'slug' => 'backend-development',
                'icon' => 'dns',
                'order' => 2,
                'translations' => [
                    'en' => 'Back-End Development',
                    'pt' => 'Desenvolvimento Back-End',
                    'es' => 'Desarrollo Back-End',
                    'de' => 'Back-End-Entwicklung',
                    'tr' => 'Back-End Geliştirme',
                    'fa' => 'توسعه Back-End',
                    'ar' => 'تطوير Back-End',
                ],
            ],
            [
                'slug' => 'databases',
                'icon' => 'database',
                'order' => 3,
                'translations' => [
                    'en' => 'Databases',
                    'pt' => 'Bancos de Dados',
                    'es' => 'Bases de Datos',
                    'de' => 'Datenbanken',
                    'tr' => 'Veritabanları',
                    'fa' => 'پایگاه‌های داده',
                    'ar' => 'قواعد البيانات',
                ],
            ],
            [
                'slug' => 'devops-tools',
                'icon' => 'cloud',
                'order' => 4,
                'translations' => [
                    'en' => 'DevOps & Tools',
                    'pt' => 'DevOps e Ferramentas',
                    'es' => 'DevOps y Herramientas',
                    'de' => 'DevOps und Werkzeuge',
                    'tr' => 'DevOps ve Araçlar',
                    'fa' => 'DevOps و ابزارها',
                    'ar' => 'DevOps والأدوات',
                ],
            ],
            [
                'slug' => 'programming-languages',
                'icon' => 'code',
                'order' => 5,
                'translations' => [
                    'en' => 'Programming Languages',
                    'pt' => 'Linguagens de Programação',
                    'es' => 'Lenguajes de Programación',
                    'de' => 'Programmiersprachen',
                    'tr' => 'Programlama Dilleri',
                    'fa' => 'زبان‌های برنامه‌نویسی',
                    'ar' => 'لغات البرمجة',
                ],
            ],
            [
                'slug' => 'frameworks-libraries',
                'icon' => 'extension',
                'order' => 6,
                'translations' => [
                    'en' => 'Frameworks & Libraries',
                    'pt' => 'Frameworks e Bibliotecas',
                    'es' => 'Frameworks y Librerías',
                    'de' => 'Frameworks und Bibliotheken',
                    'tr' => 'Frameworkler ve Kütüphaneler',
                    'fa' => 'فریم‌ورک‌ها و کتابخانه‌ها',
                    'ar' => 'الأطر والمكتبات',
                ],
            ],
            [
                'slug' => 'software-architecture',
                'icon' => 'account_tree',
                'order' => 7,
                'translations' => [
                    'en' => 'Software Architecture',
                    'pt' => 'Arquitetura de Software',
                    'es' => 'Arquitectura de Software',
                    'de' => 'Softwarearchitektur',
                    'tr' => 'Yazılım Mimarisi',
                    'fa' => 'معماری نرم‌افزار',
                    'ar' => 'هندسة البرمجيات',
                ],
            ],
            [
                'slug' => 'testing-quality',
                'icon' => 'verified',
                'order' => 8,
                'translations' => [
                    'en' => 'Testing & Quality',
                    'pt' => 'Testes e Qualidade',
                    'es' => 'Pruebas y Calidad',
                    'de' => 'Tests und Qualität',
                    'tr' => 'Test ve Kalite',
                    'fa' => 'تست و کیفیت',
                    'ar' => 'الاختبار والجودة',
                ],
            ],
            [
                'slug' => 'human-languages',
                'icon' => 'language',
                'order' => 9,
                'translations' => [
                    'en' => 'Languages',
                    'pt' => 'Idiomas',
                    'es' => 'Idiomas',
                    'de' => 'Sprachen',
                    'tr' => 'Diller',
                    'fa' => 'زبان‌ها',
                    'ar' => 'اللغات',
                ],
            ],

            [
                'slug' => 'design-tools',
                'icon' => 'palette',
                'order' => 10,
                'translations' => [
                    'en' => 'Design Tools',
                    'pt' => 'Ferramentas de Design',
                    'es' => 'Herramientas de Diseño',
                    'de' => 'Design-Werkzeuge',
                    'tr' => 'Tasarım Araçları',
                    'fa' => 'ابزارهای طراحی',
                    'ar' => 'أدوات التصميم',
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = SkillCategory::updateOrCreate(
                [
                    'slug' => $categoryData['slug'],
                ],
                [
                    'icon' => $categoryData['icon'],
                    'order' => $categoryData['order'],
                ]
            );

            foreach ($categoryData['translations'] as $locale => $name) {
                $language = Language::where('code', $locale)->first();

                if (! $language) {
                    continue;
                }

                $category->translations()->updateOrCreate(
                    [
                        'language_id' => $language->id,
                    ],
                    [
                        'name' => $name,
                    ]
                );
            }
        }
    }
}

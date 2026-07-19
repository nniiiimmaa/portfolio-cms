<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\ProjectType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTypeTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = Language::pluck('id', 'code');

        $translations = [

            'web-application' => [
                'en' => 'Web Application',
                'pt' => 'Aplicação Web',
                'es' => 'Aplicación Web',
                'de' => 'Webanwendung',
                'tr' => 'Web Uygulaması',
                'fa' => 'اپلیکیشن وب',
                'ar' => 'تطبيق ويب',
            ],
            'mobile-application' => [
                'en' => 'Mobile Application',
                'pt' => 'Aplicação Mobile',
                'es' => 'Aplicación Móvil',
                'de' => 'Mobile Anwendung',
                'tr' => 'Mobil Uygulama',
                'fa' => 'اپلیکیشن موبایل',
                'ar' => 'تطبيق جوال',
            ],
            'desktop-application' => [
                'en' => 'Desktop Application',
                'pt' => 'Aplicação Desktop',
                'es' => 'Aplicación de Escritorio',
                'de' => 'Desktop-Anwendung',
                'tr' => 'Masaüstü Uygulaması',
                'fa' => 'اپلیکیشن دسکتاپ',
                'ar' => 'تطبيق سطح المكتب',
            ],
            'api' => [
                'en' => 'API',
                'pt' => 'API',
                'es' => 'API',
                'de' => 'API',
                'tr' => 'API',
                'fa' => 'رابط برنامه‌نویسی',
                'ar' => 'واجهة برمجة التطبيقات',
            ],
            'library' => [
                'en' => 'Library',
                'pt' => 'Biblioteca',
                'es' => 'Biblioteca',
                'de' => 'Bibliothek',
                'tr' => 'Kütüphane',
                'fa' => 'کتابخانه',
                'ar' => 'مكتبة',
            ],
            'game' => [
                'en' => 'Game',
                'pt' => 'Jogo',
                'es' => 'Juego',
                'de' => 'Spiel',
                'tr' => 'Oyun',
                'fa' => 'بازی',
                'ar' => 'لعبة',
            ],
            'other' => [
                'en' => 'Other',
                'pt' => 'Outro',
                'es' => 'Otro',
                'de' => 'Sonstiges',
                'tr' => 'Diğer',
                'fa' => 'سایر',
                'ar' => 'أخرى',
            ],
        ];

        foreach ($translations as $slug => $items) {
            $projectType = ProjectType::where(
                'slug',
                $slug
            )->first();
            foreach ($items as $locale => $name) {
                $projectType->translations()->updateOrCreate(
                    [
                        'language_id' => $languages[$locale],
                    ],

                    [
                        'name' => $name,
                    ]
                );
            }
        }
    }
}

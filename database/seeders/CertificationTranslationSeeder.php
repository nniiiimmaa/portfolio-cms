<?php

namespace Database\Seeders;

use App\Models\Certification;
use App\Models\Language;
use Illuminate\Database\Seeder;

class CertificationTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = Language::pluck('id', 'code');
        $certificationData = [
            'en' => [
                [
                    'title' => 'Laravel Framework Certification',
                    'issuer_name' => 'Laravel Academy',
                    'issuer_country' => 'United States',
                    'description' => 'Certification focused on Laravel framework development, backend architecture, database management, and modern PHP application development.',
                ],
                [
                    'title' => 'Vue.js Professional Certification',
                    'issuer_name' => 'Vue School',
                    'issuer_country' => 'Netherlands',
                    'description' => 'Professional certification covering Vue.js fundamentals, component architecture, state management, and modern frontend development.',
                ],
                [
                    'title' => 'Frontend Web Development Certification',
                    'issuer_name' => 'FreeCodeCamp',
                    'issuer_country' => 'United States',
                    'description' => 'Certification focused on HTML, CSS, JavaScript, responsive design, and building modern web applications.',
                ],
            ],
            'pt' => [
                [
                    'title' => 'Certificação do Framework Laravel',
                    'issuer_name' => 'Laravel Academy',
                    'issuer_country' => 'Estados Unidos',
                    'description' => 'Certificação focada no desenvolvimento com Laravel, arquitetura backend, gerenciamento de bancos de dados e desenvolvimento de aplicações PHP modernas.',
                ],
                [
                    'title' => 'Certificação Profissional Vue.js',
                    'issuer_name' => 'Vue School',
                    'issuer_country' => 'Países Baixos',
                    'description' => 'Certificação profissional sobre fundamentos do Vue.js, arquitetura de componentes, gerenciamento de estado e desenvolvimento frontend moderno.',
                ],
                [
                    'title' => 'Certificação de Desenvolvimento Web Front-End',
                    'issuer_name' => 'FreeCodeCamp',
                    'issuer_country' => 'Estados Unidos',
                    'description' => 'Certificação focada em HTML, CSS, JavaScript, design responsivo e criação de aplicações web modernas.',
                ],
            ],
            'es' => [
                [
                    'title' => 'Certificación del Framework Laravel',
                    'issuer_name' => 'Laravel Academy',
                    'issuer_country' => 'Estados Unidos',
                    'description' => 'Certificación enfocada en desarrollo con Laravel, arquitectura backend, gestión de bases de datos y aplicaciones PHP modernas.',
                ],
                [
                    'title' => 'Certificación Profesional de Vue.js',
                    'issuer_name' => 'Vue School',
                    'issuer_country' => 'Países Bajos',
                    'description' => 'Certificación profesional sobre fundamentos de Vue.js, arquitectura de componentes, gestión de estado y desarrollo frontend moderno.',
                ],
                [
                    'title' => 'Certificación de Desarrollo Web Front-End',
                    'issuer_name' => 'FreeCodeCamp',
                    'issuer_country' => 'Estados Unidos',
                    'description' => 'Certificación enfocada en HTML, CSS, JavaScript, diseño adaptable y creación de aplicaciones web modernas.',
                ],
            ],
            'de' => [
                [
                    'title' => 'Laravel Framework Zertifizierung',
                    'issuer_name' => 'Laravel Academy',
                    'issuer_country' => 'Vereinigte Staaten',
                    'description' => 'Zertifizierung mit Schwerpunkt auf Laravel-Entwicklung, Backend-Architektur, Datenbankverwaltung und moderner PHP-Anwendungsentwicklung.',
                ],
                [
                    'title' => 'Professionelle Vue.js Zertifizierung',
                    'issuer_name' => 'Vue School',
                    'issuer_country' => 'Niederlande',
                    'description' => 'Professionelle Zertifizierung zu Vue.js-Grundlagen, Komponentenarchitektur, Zustandsverwaltung und moderner Frontend-Entwicklung.',
                ],
                [
                    'title' => 'Frontend Webentwicklung Zertifizierung',
                    'issuer_name' => 'FreeCodeCamp',
                    'issuer_country' => 'Vereinigte Staaten',
                    'description' => 'Zertifizierung mit Fokus auf HTML, CSS, JavaScript, responsives Design und moderne Webanwendungen.',
                ],
            ],
            'tr' => [
                [
                    'title' => 'Laravel Framework Sertifikası',
                    'issuer_name' => 'Laravel Academy',
                    'issuer_country' => 'Amerika Birleşik Devletleri',
                    'description' => 'Laravel geliştirme, backend mimarisi, veritabanı yönetimi ve modern PHP uygulama geliştirme konularına odaklanan sertifika.',
                ],
                [
                    'title' => 'Vue.js Profesyonel Sertifikası',
                    'issuer_name' => 'Vue School',
                    'issuer_country' => 'Hollanda',
                    'description' => 'Vue.js temelleri, bileşen mimarisi, durum yönetimi ve modern frontend geliştirme konularını kapsayan profesyonel sertifika.',
                ],
                [
                    'title' => 'Frontend Web Geliştirme Sertifikası',
                    'issuer_name' => 'FreeCodeCamp',
                    'issuer_country' => 'Amerika Birleşik Devletleri',
                    'description' => 'HTML, CSS, JavaScript, duyarlı tasarım ve modern web uygulamaları geliştirme üzerine sertifika.',
                ],
            ],
            'fa' => [
                [
                    'title' => 'گواهینامه فریم‌ورک Laravel',
                    'issuer_name' => 'Laravel Academy',
                    'issuer_country' => 'ایالات متحده',
                    'description' => 'گواهینامه‌ای با تمرکز بر توسعه Laravel، معماری بک‌اند، مدیریت پایگاه داده و توسعه برنامه‌های مدرن PHP.',
                ],
                [
                    'title' => 'گواهینامه حرفه‌ای Vue.js',
                    'issuer_name' => 'Vue School',
                    'issuer_country' => 'هلند',
                    'description' => 'گواهینامه حرفه‌ای شامل مبانی Vue.js، معماری کامپوننت‌ها، مدیریت وضعیت و توسعه مدرن فرانت‌اند.',
                ],
                [
                    'title' => 'گواهینامه توسعه وب فرانت‌اند',
                    'issuer_name' => 'FreeCodeCamp',
                    'issuer_country' => 'ایالات متحده',
                    'description' => 'گواهینامه‌ای با تمرکز بر HTML، CSS، JavaScript، طراحی واکنش‌گرا و ساخت برنامه‌های وب مدرن.',
                ],
            ],
            'ar' => [
                [
                    'title' => 'شهادة إطار Laravel',
                    'issuer_name' => 'Laravel Academy',
                    'issuer_country' => 'الولايات المتحدة',
                    'description' => 'شهادة تركز على تطوير Laravel، هندسة البرمجيات الخلفية، إدارة قواعد البيانات وتطوير تطبيقات PHP الحديثة.',
                ],
                [
                    'title' => 'شهادة Vue.js الاحترافية',
                    'issuer_name' => 'Vue School',
                    'issuer_country' => 'هولندا',
                    'description' => 'شهادة احترافية تغطي أساسيات Vue.js، هندسة المكونات، إدارة الحالة وتطوير الواجهات الحديثة.',
                ],
                [
                    'title' => 'شهادة تطوير الويب Front-End',
                    'issuer_name' => 'FreeCodeCamp',
                    'issuer_country' => 'الولايات المتحدة',
                    'description' => 'شهادة تركز على HTML وCSS وJavaScript والتصميم المتجاوب وإنشاء تطبيقات ويب حديثة.',
                ],
            ],
        ];

        foreach (Certification::all() as $index => $certification) {
            foreach ($languages as $code => $languageId) {
                $data = $certificationData[$code][$index];
                $certification->translations()->updateOrCreate(
                    [
                        'language_id' => $languageId,
                    ],
                    [
                        'title' => $data['title'],
                        'issuer_name' => $data['issuer_name'],
                        'issuer_country' => $data['issuer_country'],
                        'description' => $data['description'],
                    ]
                );
            }
        }
    }
}

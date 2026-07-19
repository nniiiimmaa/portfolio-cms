<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = Language::pluck('id', 'code');


        $translations = [
            'vue-js' => [
                'en' => [
                    'name' => 'Vue.js',
                    'description' => 'Progressive JavaScript framework for building modern and reactive user interfaces.',
                ],
                'pt' => [
                    'name' => 'Vue.js',
                    'description' => 'Framework JavaScript progressivo para criar interfaces modernas e reativas.',
                ],
                'es' => [
                    'name' => 'Vue.js',
                    'description' => 'Framework JavaScript progresivo para crear interfaces modernas y reactivas.',
                ],
                'fa' => [
                    'name' => 'ویو جی‌اس',
                    'description' => 'فریم‌ورک جاوااسکریپت برای ساخت رابط‌های کاربری مدرن و واکنش‌گرا.',
                ],
                'tr' => [
                    'name' => 'Vue.js',
                    'description' => 'Modern ve reaktif kullanıcı arayüzleri oluşturmak için JavaScript frameworkü.',
                ],
                'ar' => [
                    'name' => 'Vue.js',
                    'description' => 'إطار JavaScript لبناء واجهات مستخدم حديثة وتفاعلية.',
                ],
                'de' => [
                    'name' => 'Vue.js',
                    'description' => 'Progressives JavaScript-Framework zur Erstellung moderner und reaktiver Benutzeroberflächen.',
                ],
            ],


            'laravel' => [
                'en' => [
                    'name' => 'Laravel',
                    'description' => 'PHP framework for building scalable, secure, and maintainable backend applications.',
                ],
                'pt' => [
                    'name' => 'Laravel',
                    'description' => 'Framework PHP para criar aplicações backend escaláveis, seguras e fáceis de manter.',
                ],
                'es' => [
                    'name' => 'Laravel',
                    'description' => 'Framework PHP para crear aplicaciones backend escalables, seguras y mantenibles.',
                ],
                'fa' => [
                    'name' => 'لاراول',
                    'description' => 'فریم‌ورک PHP برای ساخت برنامه‌های بک‌اند مقیاس‌پذیر و قابل نگهداری.',
                ],
                'tr' => [
                    'name' => 'Laravel',
                    'description' => 'Ölçeklenebilir ve güvenli backend uygulamaları geliştirmek için PHP frameworkü.',
                ],
                'ar' => [
                    'name' => 'Laravel',
                    'description' => 'إطار PHP لبناء تطبيقات خلفية آمنة وقابلة للتوسع والصيانة.',
                ],
                'de' => [
                    'name' => 'Laravel',
                    'description' => 'PHP-Framework für skalierbare und wartbare Backend-Anwendungen.',
                ],
            ],


            'php' => [
                'en' => [
                    'name' => 'PHP',
                    'description' => 'Server-side programming language used for dynamic web applications.',
                ],
                'pt' => [
                    'name' => 'PHP',
                    'description' => 'Linguagem de programação do lado do servidor usada em aplicações web dinâmicas.',
                ],
                'es' => [
                    'name' => 'PHP',
                    'description' => 'Lenguaje de programación del servidor utilizado para aplicaciones web dinámicas.',
                ],
                'fa' => [
                    'name' => 'PHP',
                    'description' => 'زبان برنامه‌نویسی سمت سرور برای ساخت برنامه‌های وب پویا.',
                ],
                'tr' => [
                    'name' => 'PHP',
                    'description' => 'Dinamik web uygulamaları için kullanılan sunucu taraflı programlama dili.',
                ],
                'ar' => [
                    'name' => 'PHP',
                    'description' => 'لغة برمجة من جانب الخادم تستخدم لبناء تطبيقات ويب ديناميكية.',
                ],
                'de' => [
                    'name' => 'PHP',
                    'description' => 'Serverseitige Programmiersprache für dynamische Webanwendungen.',
                ],
            ],


            'javascript' => [
                'en' => [
                    'name' => 'JavaScript',
                    'description' => 'Programming language for creating interactive and dynamic web experiences.',
                ],
                'pt' => [
                    'name' => 'JavaScript',
                    'description' => 'Linguagem de programação para criar experiências web interativas e dinâmicas.',
                ],
                'es' => [
                    'name' => 'JavaScript',
                    'description' => 'Lenguaje de programación para crear experiencias web interactivas y dinámicas.',
                ],
                'fa' => [
                    'name' => 'جاوااسکریپت',
                    'description' => 'زبان برنامه‌نویسی برای ایجاد تجربه‌های وب پویا و تعاملی.',
                ],
                'tr' => [
                    'name' => 'JavaScript',
                    'description' => 'Etkileşimli ve dinamik web deneyimleri oluşturmak için programlama dili.',
                ],
                'ar' => [
                    'name' => 'JavaScript',
                    'description' => 'لغة برمجة لإنشاء تجارب ويب تفاعلية وديناميكية.',
                ],
                'de' => [
                    'name' => 'JavaScript',
                    'description' => 'Programmiersprache für interaktive und dynamische Web-Erlebnisse.',
                ],
            ],

            'typescript' => [
                'en' => [
                    'name' => 'TypeScript',
                    'description' => 'Typed programming language that extends JavaScript for scalable applications.',
                ],
                'pt' => [
                    'name' => 'TypeScript',
                    'description' => 'Linguagem tipada que estende JavaScript para aplicações escaláveis.',
                ],
                'es' => [
                    'name' => 'TypeScript',
                    'description' => 'Lenguaje tipado que amplía JavaScript para aplicaciones escalables.',
                ],
                'fa' => [
                    'name' => 'تایپ‌اسکریپت',
                    'description' => 'زبان برنامه‌نویسی تایپ‌دار که جاوااسکریپت را برای برنامه‌های بزرگ‌تر توسعه می‌دهد.',
                ],
                'tr' => [
                    'name' => 'TypeScript',
                    'description' => 'Ölçeklenebilir uygulamalar için JavaScript geliştiren tip güvenli programlama dili.',
                ],
                'ar' => [
                    'name' => 'TypeScript',
                    'description' => 'لغة برمجة مكتوبة توسع JavaScript لبناء تطبيقات قابلة للتوسع.',
                ],
                'de' => [
                    'name' => 'TypeScript',
                    'description' => 'Typisierte Programmiersprache, die JavaScript für skalierbare Anwendungen erweitert.',
                ],
            ],
        ];


        foreach ($translations as $slug => $languagesData) {
            $skill = Skill::where('slug', $slug)->first();

            if (!$skill) {
                continue;
            }

            foreach ($languagesData as $code => $data) {
                $skill->translations()->updateOrCreate(
                    [
                        'language_id' => $languages[$code],
                    ],
                    $data
                );
            }
        }
    }
}

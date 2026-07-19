<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $about = About::first();
        $languages = Language::pluck('id', 'code');

        $translations = [
            [
                'language_id' => $languages['en'],
                'name' => 'Nima',
                'title' => 'Front-End Developer',
                'description' => 'I am a Front-End Developer focused on building modern, scalable, and user-centered web applications. I specialize in Vue.js, Laravel, and modern frontend technologies, creating responsive interfaces with clean architecture, maintainable code, and efficient user experiences.',
                'availability_text' => 'Open to Opportunities',
            ],
            [
                'language_id' => $languages['pt'],
                'name' => 'Nima',
                'title' => 'Desenvolvedor Front-End',
                'description' => 'Sou Desenvolvedor Front-End focado na criação de aplicações web modernas, escaláveis e centradas no usuário. Tenho experiência com Vue.js, Laravel e tecnologias modernas de frontend, desenvolvendo interfaces responsivas com arquitetura limpa e código sustentável.',
                'availability_text' => 'Aberto a Oportunidades',
            ],
            [
                'language_id' => $languages['fa'],
                'name' => 'نیما',
                'title' => 'توسعه‌دهنده فرانت‌اند',
                'description' => 'من یک توسعه‌دهنده فرانت‌اند هستم که روی ساخت برنامه‌های وب مدرن، مقیاس‌پذیر و کاربرمحور تمرکز دارم. در Vue.js، Laravel و فناوری‌های مدرن فرانت‌اند تجربه دارم و رابط‌های کاربری واکنش‌گرا با معماری تمیز ایجاد می‌کنم.',
                'availability_text' => 'آماده همکاری',
            ],
            [
                'language_id' => $languages['es'],
                'name' => 'Nima',
                'title' => 'Desarrollador Front-End',
                'description' => 'Soy un desarrollador Front-End enfocado en crear aplicaciones web modernas, escalables y centradas en el usuario.',
                'availability_text' => 'Abierto a oportunidades',
            ],
            [
                'language_id' => $languages['de'],
                'name' => 'Nima',
                'title' => 'Front-End Entwickler',
                'description' => 'Ich bin ein Front-End Entwickler mit Fokus auf moderne, skalierbare und benutzerorientierte Webanwendungen.',
                'availability_text' => 'Offen für Möglichkeiten',
            ],
            [
                'language_id' => $languages['tr'],
                'name' => 'Nima',
                'title' => 'Front-End Geliştirici',
                'description' => 'Modern, ölçeklenebilir ve kullanıcı odaklı web uygulamaları geliştirmeye odaklanan bir Front-End geliştiricisiyim.',
                'availability_text' => 'Yeni Fırsatlara Açık',
            ],
            [
                'language_id' => $languages['ar'],
                'name' => 'نيما',
                'title' => 'مطور واجهات أمامية',
                'description' => 'أنا مطور واجهات أمامية أركز على بناء تطبيقات ويب حديثة وقابلة للتوسع وموجهة للمستخدم.',
                'availability_text' => 'متاح للفرص',
            ],
        ];


        foreach ($translations as $translation) {
            $about->translations()->updateOrCreate(
                [
                    'language_id' => $translation['language_id'],
                ],
                $translation
            );
        }
    }
}

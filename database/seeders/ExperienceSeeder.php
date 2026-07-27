<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\Language;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                $experiences = [
            [
                'company' => 'Parsis Global',
                'location' => 'Antalya, Turkey',
                'start_date' => '2021-10-01',
                'end_date' => '2023-10-01',
                'current' => false,
                'technologies' => [
                    'HTML5',
                    'CSS',
                    'JavaScript',
                ],
                'order' => 1,
                'translations' => [
                    'en' => [
                        'position' => 'Web Developer Intern',
                        'description' => 'Entry-level web development experience focused on learning and applying HTML, CSS, and JavaScript fundamentals. Built responsive web pages and interactive features while developing a solid understanding of semantic HTML, modern CSS techniques, basic DOM manipulation, and clean coding practices. Gained practical experience through small projects, debugging, iterative improvements, and maintaining existing websites within a professional environment.',
                    ],
                    'pt' => [
                        'position' => 'Estagiário de Desenvolvimento Web',
                        'description' => 'Experiência inicial em desenvolvimento web com foco no aprendizado e aplicação dos fundamentos de HTML, CSS e JavaScript. Desenvolveu páginas web responsivas e recursos interativos, adquirindo conhecimentos em HTML semântico, CSS moderno, manipulação básica do DOM e boas práticas de programação por meio de pequenos projetos e manutenção de websites.',
                    ],
                    'es' => [
                        'position' => 'Practicante de Desarrollo Web',
                        'description' => 'Experiencia inicial en desarrollo web centrada en el aprendizaje y aplicación de HTML, CSS y JavaScript. Desarrolló páginas web responsivas y funciones interactivas mientras adquiría experiencia práctica en HTML semántico, CSS moderno, manipulación del DOM y buenas prácticas de programación.',
                    ],
                    'de' => [
                        'position' => 'Praktikant Webentwicklung',
                        'description' => 'Einstieg in die Webentwicklung mit Schwerpunkt auf HTML, CSS und JavaScript. Entwicklung responsiver Webseiten und interaktiver Funktionen sowie praktische Erfahrung mit semantischem HTML, modernem CSS, DOM-Manipulation und sauberem Code.',
                    ],
                    'tr' => [
                        'position' => 'Web Geliştirme Stajyeri',
                        'description' => 'HTML, CSS ve JavaScript temellerine odaklanan giriş seviyesinde web geliştirme deneyimi. Duyarlı web sayfaları ve etkileşimli özellikler geliştirirken semantik HTML, modern CSS, DOM manipülasyonu ve temiz kod yazımı konusunda deneyim kazandı.',
                    ],
                    'fa' => [
                        'position' => 'کارآموز توسعه وب',
                        'description' => 'تجربه اولیه در توسعه وب با تمرکز بر یادگیری و به‌کارگیری مبانی HTML، CSS و JavaScript. در توسعه صفحات وب واکنش‌گرا، قابلیت‌های تعاملی، HTML معنایی، CSS مدرن، کار با DOM و اصول کدنویسی تمیز تجربه عملی کسب شد.',
                    ],
                    'ar' => [
                        'position' => 'متدرب تطوير ويب',
                        'description' => 'خبرة أولية في تطوير الويب ركزت على تعلم وتطبيق أساسيات HTML وCSS وJavaScript. تم تطوير صفحات ويب متجاوبة وميزات تفاعلية مع اكتساب خبرة عملية في HTML الدلالي وCSS الحديث والتعامل مع DOM وكتابة الشيفرة النظيفة.',
                    ],
                ],
            ],

            [
                'company' => 'C-TEC',
                'location' => 'Maringá, Brazil',
                'start_date' => '2023-12-01',
                'end_date' => '2026-04-30',
                'current' => false,
                'technologies' => [
                    'JavaScript',
                    'Vue',
                    'Tailwind CSS',
                    'BEM',
                    'laravel'
                ],
                'order' => 2,
                'translations' => [
                    'en' => [
                        'position' => 'Front-End Developer Intern',
                        'description' => 'Completed a two-year internship at C-TEC, gaining hands-on experience as a Front-End Developer within a collaborative team of approximately 20 members. Contributed to the development and maintenance of web-based systems designed for educational institutions across Brazil, supporting a wide range of users and use cases. Worked in a multilingual environment, adapting interfaces and content to support Portuguese, English, and Spanish while ensuring accessibility and usability. Participated in feature implementation, debugging, code collaboration, and component-based development using Vue.js integrated with Laravel applications. This experience strengthened my ability to build scalable front-end solutions, collaborate effectively in agile teams, and maintain high code quality in large-scale projects.',
                    ],
                    'pt' => [
                        'position' => 'Estagiário de Desenvolvedor Front-End',
                        'description' => 'Concluiu um estágio de dois anos na C-TEC, adquirindo experiência prática como Desenvolvedor Front-End em uma equipe colaborativa de aproximadamente 20 integrantes. Contribuiu para o desenvolvimento e manutenção de sistemas web voltados para instituições de ensino em todo o Brasil. Trabalhou em um ambiente multilíngue utilizando Português, Inglês e Espanhol, desenvolvendo interfaces responsivas com Vue.js integradas ao Laravel e participando de implementação de funcionalidades, correção de bugs e colaboração em equipe seguindo metodologias ágeis.',
                    ],
                    'es' => [
                        'position' => 'Practicante de Front-End',
                        'description' => 'Realizó una pasantía de dos años en C-TEC como Desarrollador Front-End dentro de un equipo de aproximadamente 20 integrantes. Participó en el desarrollo y mantenimiento de sistemas web para instituciones educativas en Brasil, trabajando con interfaces multilingües en portugués, inglés y español utilizando Vue.js integrado con Laravel.',
                    ],
                    'de' => [
                        'position' => 'Praktikant Front-End Entwicklung',
                        'description' => 'Absolvierte ein zweijähriges Praktikum bei C-TEC als Front-End-Entwickler in einem Team von etwa 20 Entwicklern. Mitarbeit an webbasierten Systemen für Bildungseinrichtungen in Brasilien mit Vue.js und Laravel sowie an mehrsprachigen Benutzeroberflächen und skalierbaren Anwendungen.',
                    ],
                    'tr' => [
                        'position' => 'Front-End Geliştirici Stajyeri',
                        'description' => 'C-TEC bünyesinde yaklaşık 20 kişilik bir ekipte iki yıllık Front-End stajını tamamladı. Brezilya genelindeki eğitim kurumları için geliştirilen çok dilli web sistemlerinin geliştirilmesi ve bakımına Vue.js ve Laravel kullanarak katkıda bulundu.',
                    ],
                    'fa' => [
                        'position' => 'کارآموز توسعه‌دهنده فرانت‌اند',
                        'description' => 'دوره کارآموزی دو ساله خود را در شرکت C-TEC به عنوان توسعه‌دهنده فرانت‌اند در تیمی متشکل از حدود ۲۰ نفر گذراند. در توسعه و نگهداری سامانه‌های تحت وب برای مراکز آموزشی سراسر برزیل مشارکت داشت و با استفاده از Vue.js و Laravel در محیطی چندزبانه فعالیت کرد.',
                    ],
                    'ar' => [
                        'position' => 'متدرب مطور Front-End',
                        'description' => 'أكمل تدريباً لمدة عامين في C-TEC كمطور Front-End ضمن فريق يضم حوالي 20 مطوراً. ساهم في تطوير وصيانة أنظمة ويب للمؤسسات التعليمية في البرازيل، مع تطوير واجهات متعددة اللغات باستخدام Vue.js والتكامل مع Laravel.',
                    ],
                ],
            ],

            [
                'company' => 'C-TEC',
                'location' => 'Maringá, Brazil',
                'start_date' => '2026-05-01',
                'end_date' => null,
                'current' => true,
                'technologies' => [
                    'Vue',
                    'Pinia',
                    'VueUse',
                    'I18n',
                    'PrimeVue',
                    'NPM',
                    'SCSS',
                    'Docker'
                ],
                'order' => 3,
                'translations' => [
                    'en' => [
                        'position' => 'Front-End Developer',
                        'description' => 'Working as a contracted full-time Front-End Developer in a collaborative environment with around 25 developers, contributing to multilingual systems in Portuguese, English, and Spanish. The company provides educational services across South America, including Brazil, Argentina, and Uruguay, supporting a large user base. This role has strengthened my teamwork, communication, and responsibility within large-scale projects while collaborating with professionals from different cultural backgrounds. My primary focus is specializing in Vue.js and continuously improving code quality, scalability, maintainability, and front-end best practices.',
                    ],
                    'pt' => [
                        'position' => 'Desenvolvedor Front-End',
                        'description' => 'Atua como Desenvolvedor Front-End em tempo integral em um ambiente colaborativo com cerca de 25 desenvolvedores, contribuindo para sistemas multilíngues em Português, Inglês e Espanhol. Desenvolve soluções para instituições de ensino em diversos países da América do Sul, com foco em Vue.js, qualidade de código, escalabilidade e boas práticas de desenvolvimento.',
                    ],
                    'es' => [
                        'position' => 'Desarrollador Front-End',
                        'description' => 'Trabaja como Desarrollador Front-End a tiempo completo en un equipo de aproximadamente 25 desarrolladores, desarrollando sistemas multilingües para instituciones educativas en Sudamérica con énfasis en Vue.js, escalabilidad y calidad del código.',
                    ],
                    'de' => [
                        'position' => 'Front-End Entwickler',
                        'description' => 'Arbeitet als Front-End-Entwickler in einem Team von rund 25 Entwicklern und entwickelt mehrsprachige Anwendungen für Bildungseinrichtungen in Südamerika. Der Schwerpunkt liegt auf Vue.js, Skalierbarkeit und hochwertiger Softwareentwicklung.',
                    ],
                    'tr' => [
                        'position' => 'Front-End Geliştirici',
                        'description' => 'Yaklaşık 25 geliştiriciden oluşan bir ekipte tam zamanlı Front-End Geliştirici olarak çalışmakta ve Güney Amerika genelinde kullanılan çok dilli eğitim sistemlerinin geliştirilmesine Vue.js odaklı katkı sağlamaktadır.',
                    ],
                    'fa' => [
                        'position' => 'توسعه‌دهنده فرانت‌اند',
                        'description' => 'به عنوان توسعه‌دهنده فرانت‌اند تمام‌وقت در تیمی متشکل از حدود ۲۵ توسعه‌دهنده فعالیت می‌کند و در توسعه سامانه‌های آموزشی چندزبانه مورد استفاده در کشورهای مختلف آمریکای جنوبی مشارکت دارد. تمرکز اصلی بر Vue.js، کیفیت کد، مقیاس‌پذیری و بهترین شیوه‌های توسعه فرانت‌اند است.',
                    ],
                    'ar' => [
                        'position' => 'مطور Front-End',
                        'description' => 'يعمل كمطور Front-End بدوام كامل ضمن فريق يضم حوالي 25 مطوراً، ويساهم في تطوير أنظمة تعليمية متعددة اللغات تُستخدم في عدة دول بأمريكا الجنوبية مع التركيز على Vue.js وجودة الشيفرة وقابلية التوسع.',
                    ],
                ],
            ],
        ];

        foreach ($experiences as $experienceData) {
            $translations = $experienceData['translations'];
            unset($experienceData['translations']);

            $experience = Experience::updateOrCreate(
                [
                    'company' => $experienceData['company'],
                    'start_date' => $experienceData['start_date'],
                ],
                $experienceData
            );

            foreach ($translations as $locale => $translation) {
                $language = Language::where('code', $locale)->first();

                if (! $language) {
                    continue;
                }

                $experience->translations()->updateOrCreate(
                    [
                        'language_id' => $language->id,
                    ],
                    $translation
                );
            }
        }
    }
}

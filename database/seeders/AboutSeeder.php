<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\Language;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $about = About::updateOrCreate([
            'available' => true,
        ]);

        $translations = [
            'en' => [
                'name' => 'Nima',
                'title' => 'Front-End Developer',
                'description' => 'I build thoughtful digital experiences where design and engineering meet. My focus is creating modern, scalable, and maintainable web applications through clean architecture, efficient development workflows, and user-centered solutions.',
                'availability_text' => 'Available for Work',
            ],
            'pt' => [
                'name' => 'Nima',
                'title' => 'Desenvolvedor Front-End',
                'description' => 'Desenvolvo experiências digitais cuidadosas onde design e engenharia se encontram. Meu foco é criar aplicações web modernas, escaláveis e fáceis de manter utilizando arquitetura limpa, fluxos de desenvolvimento eficientes e soluções centradas no usuário.',
                'availability_text' => 'Disponível para Trabalho',
            ],
            'es' => [
                'name' => 'Nima',
                'title' => 'Desarrollador Front-End',
                'description' => 'Creo experiencias digitales cuidadas donde el diseño y la ingeniería se encuentran. Mi enfoque está en desarrollar aplicaciones web modernas, escalables y mantenibles utilizando arquitectura limpia, herramientas eficientes y soluciones centradas en el usuario.',
                'availability_text' => 'Disponible para Trabajar',
            ],
            'fa' => [
                'name' => 'نیما',
                'title' => 'توسعه‌دهنده Front-End',
                'description' => 'تجربه‌های دیجیتال حرفه‌ای را در نقطه اتصال طراحی و مهندسی ایجاد می‌کنم. تمرکز من توسعه برنامه‌های وب مدرن، مقیاس‌پذیر و قابل نگهداری با استفاده از معماری تمیز، ابزارهای توسعه بهینه و راهکارهای کاربرمحور است.',
                'availability_text' => 'آماده همکاری',
            ],
            'tr' => [
                'name' => 'Nima',
                'title' => 'Front-End Geliştirici',
                'description' => 'Tasarım ve yazılım mühendisliğinin kesişiminde, modern ve etkili dijital deneyimler geliştiriyorum. Temiz mimari, güçlü geliştirme süreçleri ve kullanıcı odaklı çözümler üzerine odaklanıyorum.',
                'availability_text' => 'Çalışmaya Hazırım',
            ],
            'ar' => [
                'name' => 'نيما',
                'title' => 'مطور Front-End',
                'description' => 'أعمل على تطوير تجارب رقمية مدروسة تجمع بين التصميم والهندسة البرمجية. أركز على بناء تطبيقات ويب حديثة وقابلة للتوسع باستخدام هندسة نظيفة وأدوات تطوير فعالة وحلول تتمحور حول المستخدم.',
                'availability_text' => 'متاح للعمل',
            ],
            'de' => [
                'name' => 'Nima',
                'title' => 'Front-End Entwickler',
                'description' => 'Ich entwickle durchdachte digitale Erlebnisse an der Schnittstelle zwischen Design und Softwareentwicklung. Mein Fokus liegt auf modernen, skalierbaren und wartbaren Webanwendungen mit sauberer Architektur und effizienten Entwicklungsprozessen.',
                'availability_text' => 'Verfügbar für Arbeit',
            ],
        ];

        foreach ($translations as $locale => $data) {
            $language = Language::where('code', $locale)->first();

            if (! $language) {
                continue;
            }

            $about->translations()->updateOrCreate([
                'language_id' => $language->id,
                ...$data,
            ]);
        }
    }
}

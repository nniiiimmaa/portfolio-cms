<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = Language::pluck('id', 'code');
        $translations = [
            'en' => [
                [
                    'name' => 'John Smith',
                    'position' => 'Senior Software Engineer',
                    'company' => 'Tech Solutions',
                    'message' => 'Working together was an excellent experience. Professional, committed, and always delivering high-quality results.',
                ],
                [
                    'name' => 'Sarah Johnson',
                    'position' => 'Project Manager',
                    'company' => 'Digital Agency',
                    'message' => 'An outstanding developer with excellent communication skills and great attention to detail.',
                ],
                [
                    'name' => 'Michael Brown',
                    'position' => 'Product Owner',
                    'company' => 'Innovation Labs',
                    'message' => 'Highly recommended. Always proactive, reliable, and focused on delivering value.',
                ],
            ],

            'pt' => [
                [
                    'name' => 'João Silva',
                    'position' => 'Engenheiro de Software Sênior',
                    'company' => 'Tech Solutions',
                    'message' => 'Trabalhar junto foi uma excelente experiência. Profissional, comprometido e sempre entregando resultados de alta qualidade.',
                ],
                [
                    'name' => 'Sarah Johnson',
                    'position' => 'Gerente de Projetos',
                    'company' => 'Digital Agency',
                    'message' => 'Um desenvolvedor excepcional, com ótima comunicação e muita atenção aos detalhes.',
                ],
                [
                    'name' => 'Michael Brown',
                    'position' => 'Product Owner',
                    'company' => 'Innovation Labs',
                    'message' => 'Altamente recomendado. Sempre proativo, confiável e focado em gerar valor.',
                ],
            ],

            'es' => [
                [
                    'name' => 'Juan Silva',
                    'position' => 'Ingeniero Senior de Software',
                    'company' => 'Tech Solutions',
                    'message' => 'Trabajar juntos fue una experiencia excelente. Profesional, comprometido y siempre entregando resultados de alta calidad.',
                ],
                [
                    'name' => 'Sarah Johnson',
                    'position' => 'Gerente de Proyectos',
                    'company' => 'Digital Agency',
                    'message' => 'Un desarrollador excepcional con excelente comunicación y gran atención al detalle.',
                ],
                [
                    'name' => 'Michael Brown',
                    'position' => 'Product Owner',
                    'company' => 'Innovation Labs',
                    'message' => 'Muy recomendable. Siempre proactivo, confiable y enfocado en aportar valor.',
                ],
            ],

            'de' => [
                [
                    'name' => 'Johann Schmidt',
                    'position' => 'Senior Softwareentwickler',
                    'company' => 'Tech Solutions',
                    'message' => 'Die Zusammenarbeit war hervorragend. Professionell, engagiert und mit qualitativ hochwertigen Ergebnissen.',
                ],
                [
                    'name' => 'Sarah Johnson',
                    'position' => 'Projektmanagerin',
                    'company' => 'Digital Agency',
                    'message' => 'Ein hervorragender Entwickler mit exzellenter Kommunikation und Liebe zum Detail.',
                ],
                [
                    'name' => 'Michael Brown',
                    'position' => 'Product Owner',
                    'company' => 'Innovation Labs',
                    'message' => 'Sehr empfehlenswert. Immer proaktiv, zuverlässig und wertorientiert.',
                ],
            ],

            'tr' => [
                [
                    'name' => 'Ahmet Yılmaz',
                    'position' => 'Kıdemli Yazılım Mühendisi',
                    'company' => 'Tech Solutions',
                    'message' => 'Birlikte çalışmak harika bir deneyimdi. Profesyonel, güvenilir ve kaliteli işler ortaya koyuyor.',
                ],
                [
                    'name' => 'Sarah Johnson',
                    'position' => 'Proje Yöneticisi',
                    'company' => 'Digital Agency',
                    'message' => 'İletişimi güçlü ve detaylara önem veren başarılı bir geliştirici.',
                ],
                [
                    'name' => 'Michael Brown',
                    'position' => 'Product Owner',
                    'company' => 'Innovation Labs',
                    'message' => 'Kesinlikle tavsiye ederim. Her zaman proaktif ve çözüm odaklı.',
                ],
            ],

            'fa' => [
                [
                    'name' => 'علی رضایی',
                    'position' => 'مهندس ارشد نرم‌افزار',
                    'company' => 'Tech Solutions',
                    'message' => 'همکاری با او تجربه‌ای فوق‌العاده بود. حرفه‌ای، متعهد و همیشه باکیفیت کار می‌کند.',
                ],
                [
                    'name' => 'سارا جانسون',
                    'position' => 'مدیر پروژه',
                    'company' => 'Digital Agency',
                    'message' => 'توسعه‌دهنده‌ای توانمند با ارتباطات عالی و توجه بالا به جزئیات.',
                ],
                [
                    'name' => 'مایکل براون',
                    'position' => 'مالک محصول',
                    'company' => 'Innovation Labs',
                    'message' => 'کاملاً پیشنهاد می‌کنم. همیشه مسئولیت‌پذیر و ارزش‌آفرین است.',
                ],
            ],

            'ar' => [
                [
                    'name' => 'أحمد علي',
                    'position' => 'مهندس برمجيات أول',
                    'company' => 'Tech Solutions',
                    'message' => 'كان العمل معه تجربة رائعة. محترف وملتزم ويقدم نتائج عالية الجودة.',
                ],
                [
                    'name' => 'سارة جونسون',
                    'position' => 'مديرة مشاريع',
                    'company' => 'Digital Agency',
                    'message' => 'مطور متميز يتمتع بمهارات تواصل ممتازة واهتمام كبير بالتفاصيل.',
                ],
                [
                    'name' => 'مايكل براون',
                    'position' => 'مالك المنتج',
                    'company' => 'Innovation Labs',
                    'message' => 'أنصح به بشدة. دائمًا مبادر ويمكن الاعتماد عليه.',
                ],
            ],
        ];

        foreach (Testimonial::all() as $index => $testimonial) {
            foreach ($languages as $code => $languageId) {
                $testimonial->translations()->updateOrCreate(
                    [
                        'language_id' => $languageId,
                    ],
                    $translations[$code][$index]
                );
            }
        }
    }
}

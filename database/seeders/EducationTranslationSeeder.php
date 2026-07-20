<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $languages = Language::pluck('id', 'code');
        $educationData = [
            'en' => [
                'institution' => [
                    'Harvard University',
                    'Massachusetts Institute of Technology',
                    'Stanford University',
                ],
                'degree' => [
                    'Bachelor Degree',
                    'Master Degree',
                    'Professional Certification',
                ],
                'field' => [
                    'Computer Science',
                    'Software Engineering',
                    'Information Technology',
                ],
                'location' => [
                    'United States',
                    'United Kingdom',
                    'Germany',
                ],
                'description' => [
                    'Academic program focused on modern technologies, software development, and practical problem solving.',
                    'Advanced studies focused on engineering principles, research, and innovation.',
                    'Professional education focused on building technical skills and industry knowledge.',
                ],
            ],
            'pt' => [
                'institution' => [
                    'Universidade de Harvard',
                    'Instituto de Tecnologia de Massachusetts',
                    'Universidade de Stanford',
                ],
                'degree' => [
                    'Bacharelado',
                    'Mestrado',
                    'Certificação Profissional',
                ],
                'field' => [
                    'Ciência da Computação',
                    'Engenharia de Software',
                    'Tecnologia da Informação',
                ],
                'location' => [
                    'Estados Unidos',
                    'Reino Unido',
                    'Alemanha',
                ],
                'description' => [
                    'Programa acadêmico focado em tecnologias modernas, desenvolvimento de software e resolução prática de problemas.',
                    'Estudos avançados focados em princípios de engenharia, pesquisa e inovação.',
                    'Formação profissional voltada ao desenvolvimento de habilidades técnicas e conhecimento da indústria.',
                ],
            ],
            'es' => [
                'institution' => [
                    'Universidad de Harvard',
                    'Instituto Tecnológico de Massachusetts',
                    'Universidad de Stanford',
                ],
                'degree' => [
                    'Licenciatura',
                    'Maestría',
                    'Certificación Profesional',
                ],
                'field' => [
                    'Ciencias de la Computación',
                    'Ingeniería de Software',
                    'Tecnologías de la Información',
                ],
                'location' => [
                    'Estados Unidos',
                    'Reino Unido',
                    'Alemania',
                ],
                'description' => [
                    'Programa académico enfocado en tecnologías modernas, desarrollo de software y resolución práctica de problemas.',
                    'Estudios avanzados centrados en principios de ingeniería, investigación e innovación.',
                    'Formación profesional orientada al desarrollo de habilidades técnicas y conocimiento de la industria.',
                ],
            ],
            'de' => [
                'institution' => [
                    'Harvard-Universität',
                    'Massachusetts Institute of Technology',
                    'Stanford-Universität',
                ],
                'degree' => [
                    'Bachelor',
                    'Master',
                    'Berufszertifikat',
                ],
                'field' => [
                    'Informatik',
                    'Softwaretechnik',
                    'Informationstechnologie',
                ],
                'location' => [
                    'Vereinigte Staaten',
                    'Vereinigtes Königreich',
                    'Deutschland',
                ],
                'description' => [
                    'Akademisches Programm mit Schwerpunkt auf modernen Technologien, Softwareentwicklung und praktischer Problemlösung.',
                    'Fortgeschrittenes Studium mit Fokus auf Ingenieurwissenschaften, Forschung und Innovation.',
                    'Berufliche Ausbildung zum Aufbau technischer Fähigkeiten und Branchenkenntnisse.',
                ],
            ],
            'tr' => [
                'institution' => [
                    'Harvard Üniversitesi',
                    'Massachusetts Teknoloji Enstitüsü',
                    'Stanford Üniversitesi',
                ],
                'degree' => [
                    'Lisans Derecesi',
                    'Yüksek Lisans Derecesi',
                    'Profesyonel Sertifika',
                ],
                'field' => [
                    'Bilgisayar Bilimleri',
                    'Yazılım Mühendisliği',
                    'Bilgi Teknolojileri',
                ],
                'location' => [
                    'Amerika Birleşik Devletleri',
                    'Birleşik Krallık',
                    'Almanya',
                ],
                'description' => [
                    'Modern teknolojiler, yazılım geliştirme ve pratik problem çözmeye odaklanan akademik program.',
                    'Mühendislik prensipleri, araştırma ve inovasyona odaklanan ileri düzey eğitim.',
                    'Teknik becerileri ve sektör bilgisini geliştirmeye yönelik profesyonel eğitim.',
                ],
            ],
            'fa' => [
                'institution' => [
                    'دانشگاه هاروارد',
                    'مؤسسه فناوری ماساچوست',
                    'دانشگاه استنفورد',
                ],
                'degree' => [
                    'کارشناسی',
                    'کارشناسی ارشد',
                    'گواهی حرفه‌ای',
                ],
                'field' => [
                    'علوم کامپیوتر',
                    'مهندسی نرم‌افزار',
                    'فناوری اطلاعات',
                ],
                'location' => [
                    'ایالات متحده',
                    'بریتانیا',
                    'آلمان',
                ],
                'description' => [
                    'برنامه‌ای دانشگاهی با تمرکز بر فناوری‌های نوین، توسعه نرم‌افزار و حل مسائل عملی.',
                    'تحصیلات پیشرفته با تمرکز بر اصول مهندسی، پژوهش و نوآوری.',
                    'آموزش حرفه‌ای برای توسعه مهارت‌های فنی و دانش صنعت.',
                ],
            ],
            'ar' => [
                'institution' => [
                    'جامعة هارفارد',
                    'معهد ماساتشوستس للتكنولوجيا',
                    'جامعة ستانفورد',
                ],
                'degree' => [
                    'درجة البكالوريوس',
                    'درجة الماجستير',
                    'شهادة مهنية',
                ],
                'field' => [
                    'علوم الحاسوب',
                    'هندسة البرمجيات',
                    'تقنية المعلومات',
                ],
                'location' => [
                    'الولايات المتحدة',
                    'المملكة المتحدة',
                    'ألمانيا',
                ],
                'description' => [
                    'برنامج أكاديمي يركز على التقنيات الحديثة وتطوير البرمجيات وحل المشكلات العملية.',
                    'دراسات متقدمة تركز على مبادئ الهندسة والبحث والابتكار.',
                    'برنامج مهني يهدف إلى تطوير المهارات التقنية والمعرفة بالصناعة.',
                ],
            ],
        ];

        foreach (Education::all() as $index => $education) {
            foreach ($languages as $code => $languageId) {
                $base = $educationData[$code];
                $education->translations()->updateOrCreate(
                    [
                        'language_id' => $languageId,
                    ],
                    [
                        'institution' => $base['institution'][$index % count($base['institution'])],
                        'degree' => $base['degree'][$index % count($base['degree'])],
                        'field' => $base['field'][$index % count($base['field'])],
                        'location' => $base['location'][$index % count($base['location'])],
                        'description' => $base['description'][$index % count($base['description'])],
                    ]
                );
            }
        }
    }
}

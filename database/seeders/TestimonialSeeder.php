<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'rating' => 5,
                'approved' => true,
                'featured' => false,
                'order' => 1,
                'translations' => [
                    'en' => [
                        'name' => 'John Doe',
                        'position' => 'Project Manager',
                        'company' => 'Company Name',
                        'message' => 'Nima demonstrated strong problem-solving skills, dedication, and professionalism while contributing to software development projects. His ability to learn quickly and collaborate effectively made him a valuable member of the team.',
                    ],
                    'pt' => [
                        'name' => 'John Doe',
                        'position' => 'Gerente de Projetos',
                        'company' => 'Nome da Empresa',
                        'message' => 'Nima demonstrou excelentes habilidades de resolução de problemas, dedicação e profissionalismo durante sua contribuição em projetos de desenvolvimento de software. Sua capacidade de aprender rapidamente e colaborar de forma eficaz tornou-o um membro valioso da equipe.',
                    ],
                    'es' => [
                        'name' => 'John Doe',
                        'position' => 'Gerente de Proyecto',
                        'company' => 'Nombre de la Empresa',
                        'message' => 'Nima demostró grandes habilidades para resolver problemas, dedicación y profesionalismo durante su participación en proyectos de desarrollo de software. Su capacidad para aprender rápidamente y colaborar eficazmente lo convirtió en un miembro valioso del equipo.',
                    ],
                    'de' => [
                        'name' => 'John Doe',
                        'position' => 'Projektmanager',
                        'company' => 'Unternehmen',
                        'message' => 'Nima zeigte starke Problemlösungsfähigkeiten, Engagement und Professionalität bei der Mitarbeit an Softwareentwicklungsprojekten. Seine schnelle Lernfähigkeit und effektive Zusammenarbeit machten ihn zu einem wertvollen Teammitglied.',
                    ],
                    'tr' => [
                        'name' => 'John Doe',
                        'position' => 'Proje Yöneticisi',
                        'company' => 'Şirket Adı',
                        'message' => 'Nima, yazılım geliştirme projelerine katkı sağlarken güçlü problem çözme becerileri, bağlılık ve profesyonellik gösterdi. Hızlı öğrenme yeteneği ve etkili ekip çalışması onu değerli bir ekip üyesi yaptı.',
                    ],
                    'fa' => [
                        'name' => 'John Doe',
                        'position' => 'مدیر پروژه',
                        'company' => 'نام شرکت',
                        'message' => 'نیمـا در پروژه‌های توسعه نرم‌افزار، مهارت‌های حل مسئله، تعهد و حرفه‌ای‌گری بالایی نشان داد. توانایی یادگیری سریع و همکاری مؤثر او را به عضوی ارزشمند از تیم تبدیل کرد.',
                    ],
                    'ar' => [
                        'name' => 'John Doe',
                        'position' => 'مدير مشروع',
                        'company' => 'اسم الشركة',
                        'message' => 'أظهر نیمـا مهارات قوية في حل المشكلات والالتزام والاحترافية أثناء مساهمته في مشاريع تطوير البرمجيات. جعلته قدرته على التعلم السريع والتعاون الفعال عضوًا قيّمًا في الفريق.',
                    ],
                ],
            ],
        ];

        foreach ($testimonials as $item) {

            $translations = $item['translations'];
            unset($item['translations']);

            $testimonial = Testimonial::create($item);

            foreach ($translations as $locale => $data) {

                $language = Language::where('code', $locale)->first();

                if (! $language) {
                    continue;
                }

                $testimonial->translations()->create([
                    'language_id' => $language->id,
                    ...$data,
                ]);
            }
        }
    }
}

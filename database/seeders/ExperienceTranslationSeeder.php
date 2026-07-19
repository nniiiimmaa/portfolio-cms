<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $experience = Experience::find(1);
        $translations = [
            [
                'locale' => 'en',
                'position' => 'Front-End Developer Intern',
                'description' => 'Team-based development processes, including code collaboration, debugging, and feature implementation, were carried out following structured workflows and agile methodologies. Experience with component-based architecture, version control, and large-scale application consistency was also developed.',
            ],
            [
                'locale' => 'pt',
                'position' => 'Estagiário em Desenvolvimento Front-End',
                'description' => 'Participação em processos de desenvolvimento em equipe, incluindo colaboração em código, depuração e implementação de funcionalidades, seguindo fluxos de trabalho estruturados e metodologias ágeis. Também foi desenvolvida experiência em arquitetura baseada em componentes, controle de versão e consistência de aplicações de grande porte.',
            ],
            [
                'locale' => 'fa',
                'position' => 'کارآموز توسعه‌دهنده فرانت‌اند',
                'description' => 'در فرآیندهای توسعه تیمی شامل همکاری در کدنویسی، اشکال‌زدایی و پیاده‌سازی قابلیت‌ها بر اساس گردش‌کارهای ساختاریافته و متدولوژی‌های چابک مشارکت داشتم. همچنین در معماری مبتنی بر کامپوننت، کنترل نسخه و حفظ یکپارچگی پروژه‌های بزرگ تجربه کسب کردم.',
            ],
            [
                'locale' => 'es',
                'position' => 'Practicante de Desarrollo Front-End',
                'description' => 'Participación en procesos de desarrollo en equipo, incluyendo colaboración en el código, depuración e implementación de funcionalidades siguiendo flujos de trabajo estructurados y metodologías ágiles. También se adquirió experiencia en arquitectura basada en componentes, control de versiones y consistencia en aplicaciones de gran escala.',
            ],
            [
                'locale' => 'de',
                'position' => 'Praktikant Front-End Entwicklung',
                'description' => 'Mitarbeit an teamorientierten Entwicklungsprozessen, einschließlich Code-Zusammenarbeit, Fehlersuche und Implementierung neuer Funktionen nach strukturierten Arbeitsabläufen und agilen Methoden. Zudem wurden Erfahrungen mit komponentenbasierter Architektur, Versionskontrolle und Konsistenz großer Anwendungen gesammelt.',
            ],
            [
                'locale' => 'tr',
                'position' => 'Front-End Geliştirici Stajyeri',
                'description' => 'Kod iş birliği, hata ayıklama ve özellik geliştirme dahil olmak üzere ekip tabanlı yazılım geliştirme süreçlerinde, yapılandırılmış iş akışları ve çevik metodolojiler kullanılarak görev alındı. Ayrıca bileşen tabanlı mimari, sürüm kontrolü ve büyük ölçekli uygulama tutarlılığı konularında deneyim kazanıldı.',
            ],
            [
                'locale' => 'ar',
                'position' => 'متدرب مطور واجهات أمامية',
                'description' => 'المشاركة في عمليات التطوير ضمن فريق، بما في ذلك التعاون في كتابة الشيفرة، وتصحيح الأخطاء، وتنفيذ الميزات وفق سير عمل منظم ومنهجيات Agile. كما تم اكتساب خبرة في البنية المعتمدة على المكونات، وإدارة الإصدارات، والحفاظ على اتساق التطبيقات واسعة النطاق.',
            ],
        ];

        foreach ($translations as $translation) {
            $experience->translations()->updateOrCreate(
                [
                    'locale' => $translation['locale'],
                ],
                $translation
            );
        }
    }
}

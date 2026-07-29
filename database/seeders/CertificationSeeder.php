<?php

namespace Database\Seeders;

use App\Models\Certification;
use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CertificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $certifications = [
            [
                'issue_date' => '2022-02-03',
                'expiration_date' => null,
                'credential_id' => '5D4BL827GQ8P',
                'credential_url' => 'https://coursera.org/verify/specialization/5D4BL827GQ8P',
                'order' => 1,
                'translations' => [
                    'en' => [
                        'title' => 'Microsoft Office 365',
                        'issuer_name' => 'Microsoft',
                        'issuer_country' => 'United States',
                        'description' => 'Certification focused on Microsoft Office 365 tools and productivity solutions, covering essential concepts for working with modern cloud-based office applications.',
                    ],

                    'pt' => [
                        'title' => 'Microsoft Office 365',
                        'issuer_name' => 'Microsoft',
                        'issuer_country' => 'Estados Unidos',
                        'description' => 'Certificação focada nas ferramentas do Microsoft Office 365 e soluções de produtividade, abrangendo conceitos essenciais para o uso de aplicações modernas de escritório baseadas em nuvem.',
                    ],

                    'es' => [
                        'title' => 'Microsoft Office 365',
                        'issuer_name' => 'Microsoft',
                        'issuer_country' => 'Estados Unidos',
                        'description' => 'Certificación enfocada en las herramientas de Microsoft Office 365 y soluciones de productividad, cubriendo conceptos esenciales para trabajar con aplicaciones modernas de oficina basadas en la nube.',
                    ],

                    'de' => [
                        'title' => 'Microsoft Office 365',
                        'issuer_name' => 'Microsoft',
                        'issuer_country' => 'Vereinigte Staaten',
                        'description' => 'Zertifizierung mit Schwerpunkt auf Microsoft Office 365 Werkzeugen und Produktivitätslösungen. Behandelt wurden grundlegende Konzepte für die Arbeit mit modernen cloudbasierten Office-Anwendungen.',
                    ],

                    'tr' => [
                        'title' => 'Microsoft Office 365',
                        'issuer_name' => 'Microsoft',
                        'issuer_country' => 'Amerika Birleşik Devletleri',
                        'description' => 'Microsoft Office 365 araçları ve üretkenlik çözümlerine odaklanan sertifika. Modern bulut tabanlı ofis uygulamalarıyla çalışmak için gerekli temel kavramları kapsamaktadır.',
                    ],

                    'fa' => [
                        'title' => 'Microsoft Office 365',
                        'issuer_name' => 'Microsoft',
                        'issuer_country' => 'ایالات متحده',
                        'description' => 'گواهینامه‌ای با تمرکز بر ابزارهای Microsoft Office 365 و راهکارهای افزایش بهره‌وری که مفاهیم اساسی کار با برنامه‌های مدرن آفیس مبتنی بر فضای ابری را پوشش می‌دهد.',
                    ],

                    'ar' => [
                        'title' => 'Microsoft Office 365',
                        'issuer_name' => 'Microsoft',
                        'issuer_country' => 'الولايات المتحدة',
                        'description' => 'شهادة تركز على أدوات Microsoft Office 365 وحلول الإنتاجية، وتغطي المفاهيم الأساسية للعمل مع تطبيقات المكتب الحديثة المستندة إلى السحابة.',
                    ],
                ],
            ],

            [
                'issue_date' => '2022-02-11',
                'expiration_date' => null,
                'credential_id' => '5D3QLGQPZYZ4',
                'credential_url' => 'https://coursera.org/verify/specialization/5D3QLGQPZYZ4',
                'order' => 2,
                'translations' => [
                    'en' => [
                        'title' => 'Introduction to Computer Science and Programming',
                        'issuer_name' => 'London University',
                        'issuer_country' => 'England',
                        'description' => 'Completed an introductory computer science and programming course covering fundamental concepts of software development, computational thinking, algorithms, problem-solving, and core programming principles.',
                    ],

                    'pt' => [
                        'title' => 'Introdução à Ciência da Computação e Programação',
                        'issuer_name' => 'London University',
                        'issuer_country' => 'Inglaterra',
                        'description' => 'Concluí um curso introdutório de ciência da computação e programação, abrangendo conceitos fundamentais de desenvolvimento de software, pensamento computacional, algoritmos, resolução de problemas e princípios essenciais de programação.',
                    ],

                    'es' => [
                        'title' => 'Introducción a la Ciencia de la Computación y Programación',
                        'issuer_name' => 'London University',
                        'issuer_country' => 'Inglaterra',
                        'description' => 'Completé un curso introductorio de ciencias de la computación y programación que abarcó conceptos fundamentales de desarrollo de software, pensamiento computacional, algoritmos, resolución de problemas y principios esenciales de programación.',
                    ],

                    'de' => [
                        'title' => 'Einführung in Informatik und Programmierung',
                        'issuer_name' => 'London University',
                        'issuer_country' => 'England',
                        'description' => 'Abgeschlossener Einführungskurs in Informatik und Programmierung mit Schwerpunkt auf grundlegenden Konzepten der Softwareentwicklung, rechnerischem Denken, Algorithmen, Problemlösung und Programmierprinzipien.',
                    ],

                    'tr' => [
                        'title' => 'Bilgisayar Bilimine ve Programlamaya Giriş',
                        'issuer_name' => 'London University',
                        'issuer_country' => 'İngiltere',
                        'description' => 'Yazılım geliştirme temelleri, hesaplamalı düşünme, algoritmalar, problem çözme ve temel programlama prensiplerini kapsayan bilgisayar bilimi ve programlamaya giriş kursu tamamlandı.',
                    ],

                    'fa' => [
                        'title' => 'مقدمه‌ای بر علوم کامپیوتر و برنامه‌نویسی',
                        'issuer_name' => 'London University',
                        'issuer_country' => 'انگلستان',
                        'description' => 'یک دوره مقدماتی علوم کامپیوتر و برنامه‌نویسی با موفقیت به پایان رسید که شامل مفاهیم پایه توسعه نرم‌افزار، تفکر محاسباتی، الگوریتم‌ها، حل مسئله و اصول اصلی برنامه‌نویسی بود.',
                    ],

                    'ar' => [
                        'title' => 'مقدمة في علوم الحاسوب والبرمجة',
                        'issuer_name' => 'London University',
                        'issuer_country' => 'إنجلترا',
                        'description' => 'تم إكمال دورة تدريبية تمهيدية في علوم الحاسوب والبرمجة، تغطي المفاهيم الأساسية لتطوير البرمجيات، التفكير الحاسوبي، الخوارزميات، حل المشكلات ومبادئ البرمجة الأساسية.',
                    ],
                ],
            ],

            [
                'issue_date' => '2022-08-02',
                'expiration_date' => null,
                'credential_id' => '2757NPMR6AJ6',
                'credential_url' => 'https://coursera.org/verify/specialization/2757NPMR6AJ6',
                'order' => 3,
                'translations' => [
                    'en' => [
                        'title' => 'Web Design',
                        'issuer_name' => 'Michigan University',
                        'issuer_country' => 'United States',
                        'description' => 'Completed a web design certification focused on creating user-friendly and responsive websites, covering principles of layout design, visual hierarchy, accessibility, usability, and modern web development practices.',
                    ],

                    'pt' => [
                        'title' => 'Design de Sites',
                        'issuer_name' => 'Michigan University',
                        'issuer_country' => 'Estados Unidos',
                        'description' => 'Concluí uma certificação em design de sites com foco na criação de websites responsivos e fáceis de usar, abordando princípios de layout, hierarquia visual, acessibilidade, usabilidade e práticas modernas de desenvolvimento web.',
                    ],

                    'es' => [
                        'title' => 'Diseño Web',
                        'issuer_name' => 'Michigan University',
                        'issuer_country' => 'Estados Unidos',
                        'description' => 'Completé una certificación de diseño web enfocada en la creación de sitios web responsivos y fáciles de usar, cubriendo principios de diseño de interfaces, jerarquía visual, accesibilidad, usabilidad y prácticas modernas de desarrollo web.',
                    ],

                    'de' => [
                        'title' => 'Webdesign',
                        'issuer_name' => 'Michigan University',
                        'issuer_country' => 'Vereinigte Staaten',
                        'description' => 'Abgeschlossene Zertifizierung im Bereich Webdesign mit Schwerpunkt auf der Erstellung benutzerfreundlicher und responsiver Websites. Behandelt wurden Layoutgestaltung, visuelle Hierarchie, Barrierefreiheit, Benutzerfreundlichkeit und moderne Webentwicklungsmethoden.',
                    ],

                    'tr' => [
                        'title' => 'Web Tasarımı',
                        'issuer_name' => 'Michigan University',
                        'issuer_country' => 'Amerika Birleşik Devletleri',
                        'description' => 'Kullanıcı dostu ve duyarlı web siteleri oluşturma odaklı web tasarımı sertifikası tamamlandı. Eğitim kapsamında düzen, görsel hiyerarşi, erişilebilirlik, kullanılabilirlik ve modern web tasarım uygulamaları ele alındı.',
                    ],

                    'fa' => [
                        'title' => 'طراحی وب',
                        'issuer_name' => 'Michigan University',
                        'issuer_country' => 'ایالات متحده',
                        'description' => 'گواهینامه طراحی وب با تمرکز بر ایجاد وب‌سایت‌های کاربرپسند و واکنش‌گرا دریافت شد. این دوره شامل اصول طراحی چیدمان، سلسله‌مراتب بصری، دسترس‌پذیری، تجربه کاربری و روش‌های مدرن طراحی وب بود.',
                    ],

                    'ar' => [
                        'title' => 'تصميم الويب',
                        'issuer_name' => 'Michigan University',
                        'issuer_country' => 'الولايات المتحدة',
                        'description' => 'تم إكمال شهادة في تصميم الويب تركز على إنشاء مواقع ويب سهلة الاستخدام ومتجاوبة، وتشمل مبادئ تخطيط الصفحات، التسلسل البصري، إمكانية الوصول، قابلية الاستخدام وممارسات تصميم الويب الحديثة.',
                    ],
                ],
            ],

            [
                'issue_date' => '2023-04-07',
                'expiration_date' => null,
                'credential_id' => 'LC6GYYFZ7AHK',
                'credential_url' => 'https://coursera.org/verify/professional-cert/LC6GYYFZ7AHK',
                'order' => 4,
                'translations' => [
                    'en' => [
                        'title' => 'Google IT Support Professional Certificate',
                        'issuer_name' => 'Google',
                        'issuer_country' => 'United States',
                        'description' => 'Professional certificate covering IT support fundamentals, troubleshooting, networking, operating systems, system administration, cybersecurity basics, and technical problem-solving practices for modern IT environments.',
                    ],

                    'pt' => [
                        'title' => 'Certificado Profissional de Suporte de TI do Google',
                        'issuer_name' => 'Google',
                        'issuer_country' => 'Estados Unidos',
                        'description' => 'Certificado profissional que aborda fundamentos de suporte de TI, solução de problemas, redes, sistemas operacionais, administração de sistemas, conceitos básicos de segurança cibernética e práticas de resolução de problemas técnicos em ambientes modernos de tecnologia.',
                    ],

                    'es' => [
                        'title' => 'Certificado Profesional de Soporte de TI de Google',
                        'issuer_name' => 'Google',
                        'issuer_country' => 'Estados Unidos',
                        'description' => 'Certificado profesional que cubre fundamentos de soporte de TI, resolución de problemas, redes, sistemas operativos, administración de sistemas, conceptos básicos de ciberseguridad y prácticas de solución de problemas técnicos en entornos tecnológicos modernos.',
                    ],

                    'de' => [
                        'title' => 'Google IT Support Professional Zertifikat',
                        'issuer_name' => 'Google',
                        'issuer_country' => 'Vereinigte Staaten',
                        'description' => 'Professionelles Zertifikat mit Schwerpunkt auf IT-Support-Grundlagen, Fehlerbehebung, Netzwerken, Betriebssystemen, Systemadministration, Grundlagen der Cybersicherheit und technischen Problemlösungsmethoden in modernen IT-Umgebungen.',
                    ],

                    'tr' => [
                        'title' => 'Google IT Destek Profesyonel Sertifikası',
                        'issuer_name' => 'Google',
                        'issuer_country' => 'Amerika Birleşik Devletleri',
                        'description' => 'Modern BT ortamlarında teknik destek temelleri, sorun giderme, ağlar, işletim sistemleri, sistem yönetimi, siber güvenlik temelleri ve teknik problem çözme uygulamalarını kapsayan profesyonel sertifika.',
                    ],

                    'fa' => [
                        'title' => 'گواهینامه حرفه‌ای پشتیبانی فناوری اطلاعات گوگل',
                        'issuer_name' => 'Google',
                        'issuer_country' => 'ایالات متحده',
                        'description' => 'گواهینامه حرفه‌ای شامل مبانی پشتیبانی فناوری اطلاعات، عیب‌یابی، شبکه‌ها، سیستم‌عامل‌ها، مدیریت سیستم، مفاهیم پایه امنیت سایبری و روش‌های حل مشکلات فنی در محیط‌های مدرن فناوری اطلاعات.',
                    ],

                    'ar' => [
                        'title' => 'شهادة Google الاحترافية لدعم تكنولوجيا المعلومات',
                        'issuer_name' => 'Google',
                        'issuer_country' => 'الولايات المتحدة',
                        'description' => 'شهادة احترافية تغطي أساسيات دعم تكنولوجيا المعلومات، استكشاف الأخطاء وإصلاحها، الشبكات، أنظمة التشغيل، إدارة الأنظمة، أساسيات الأمن السيبراني وممارسات حل المشكلات التقنية في بيئات تقنية المعلومات الحديثة.',
                    ],
                ],
            ],

            [
                'issue_date' => '2026-05-14',
                'expiration_date' => null,
                'credential_id' => null,
                'credential_url' => 'https://www.freecodecamp.org/certification/nniiiimmaa/responsive-web-design-v9',
                'order' => 5,
                'translations' => [
                    'en' => [
                        'title' => 'Responsive Web Design',
                        'issuer_name' => 'freeCodeCamp',
                        'issuer_country' => 'United States',
                        'description' => 'Completed a responsive web design certification focused on HTML, CSS, responsive layouts, accessibility, CSS frameworks, and creating websites that provide consistent user experiences across different devices and screen sizes.',
                    ],

                    'pt' => [
                        'title' => 'Design Web Responsivo',
                        'issuer_name' => 'freeCodeCamp',
                        'issuer_country' => 'Estados Unidos',
                        'description' => 'Concluí uma certificação em design web responsivo com foco em HTML, CSS, layouts responsivos, acessibilidade, frameworks CSS e criação de sites que oferecem experiências consistentes em diferentes dispositivos e tamanhos de tela.',
                    ],

                    'es' => [
                        'title' => 'Diseño Web Responsivo',
                        'issuer_name' => 'freeCodeCamp',
                        'issuer_country' => 'Estados Unidos',
                        'description' => 'Completé una certificación de diseño web responsivo enfocada en HTML, CSS, diseños adaptables, accesibilidad, frameworks CSS y creación de sitios web que ofrecen experiencias consistentes en diferentes dispositivos y tamaños de pantalla.',
                    ],

                    'de' => [
                        'title' => 'Responsives Webdesign',
                        'issuer_name' => 'freeCodeCamp',
                        'issuer_country' => 'Vereinigte Staaten',
                        'description' => 'Abgeschlossene Zertifizierung im Bereich responsives Webdesign mit Schwerpunkt auf HTML, CSS, responsiven Layouts, Barrierefreiheit, CSS-Frameworks und der Entwicklung von Websites mit konsistenter Benutzererfahrung auf verschiedenen Geräten und Bildschirmgrößen.',
                    ],

                    'tr' => [
                        'title' => 'Duyarlı Web Tasarımı',
                        'issuer_name' => 'freeCodeCamp',
                        'issuer_country' => 'Amerika Birleşik Devletleri',
                        'description' => 'HTML, CSS, duyarlı tasarımlar, erişilebilirlik, CSS frameworkleri ve farklı cihazlarda ve ekran boyutlarında tutarlı kullanıcı deneyimi sağlayan web siteleri oluşturma konularına odaklanan duyarlı web tasarımı sertifikası tamamlandı.',
                    ],

                    'fa' => [
                        'title' => 'طراحی وب واکنش‌گرا',
                        'issuer_name' => 'freeCodeCamp',
                        'issuer_country' => 'ایالات متحده',
                        'description' => 'گواهینامه طراحی وب واکنش‌گرا با تمرکز بر HTML، CSS، چیدمان‌های واکنش‌گرا، دسترس‌پذیری، فریم‌ورک‌های CSS و ایجاد وب‌سایت‌هایی با تجربه کاربری یکسان در دستگاه‌ها و اندازه‌های مختلف صفحه نمایش دریافت شد.',
                    ],

                    'ar' => [
                        'title' => 'تصميم الويب المتجاوب',
                        'issuer_name' => 'freeCodeCamp',
                        'issuer_country' => 'الولايات المتحدة',
                        'description' => 'تم إكمال شهادة في تصميم الويب المتجاوب تركز على HTML وCSS والتخطيطات المتجاوبة وإمكانية الوصول وأطر عمل CSS وإنشاء مواقع ويب توفر تجربة مستخدم متسقة عبر مختلف الأجهزة وأحجام الشاشات.',
                    ],
                ],
            ],

            [
                'issue_date' => '2026-06-01',
                'expiration_date' => null,
                'credential_id' => '1R6U65J21Z',
                'credential_url' => 'https://verify.w3schools.com/1R6U65J21Z',
                'order' => 6,
                'translations' => [
                    'en' => [
                        'title' => 'Front End Development',
                        'issuer_name' => 'W3Schools',
                        'issuer_country' => 'Norway',
                        'description' => 'Certification focused on front-end development fundamentals, including HTML, CSS, JavaScript, responsive design, and modern practices for creating interactive, accessible, and user-friendly web experiences.',
                    ],

                    'pt' => [
                        'title' => 'Desenvolvimento Front-End',
                        'issuer_name' => 'W3Schools',
                        'issuer_country' => 'Noruega',
                        'description' => 'Certificação focada nos fundamentos do desenvolvimento front-end, incluindo HTML, CSS, JavaScript, design responsivo e práticas modernas para criar experiências web interativas, acessíveis e fáceis de usar.',
                    ],

                    'es' => [
                        'title' => 'Desarrollo Front-End',
                        'issuer_name' => 'W3Schools',
                        'issuer_country' => 'Noruega',
                        'description' => 'Certificación enfocada en los fundamentos del desarrollo front-end, incluyendo HTML, CSS, JavaScript, diseño responsivo y prácticas modernas para crear experiencias web interactivas, accesibles y fáciles de usar.',
                    ],

                    'de' => [
                        'title' => 'Front-End-Entwicklung',
                        'issuer_name' => 'W3Schools',
                        'issuer_country' => 'Norwegen',
                        'description' => 'Zertifizierung mit Schwerpunkt auf den Grundlagen der Front-End-Entwicklung, einschließlich HTML, CSS, JavaScript, responsivem Design und modernen Methoden zur Erstellung interaktiver, barrierefreier und benutzerfreundlicher Webanwendungen.',
                    ],

                    'tr' => [
                        'title' => 'Front-End Geliştirme',
                        'issuer_name' => 'W3Schools',
                        'issuer_country' => 'Norveç',
                        'description' => 'HTML, CSS, JavaScript, duyarlı tasarım ve etkileşimli, erişilebilir ve kullanıcı dostu web deneyimleri oluşturmak için modern geliştirme uygulamalarını kapsayan front-end geliştirme temellerine odaklanan sertifika.',
                    ],

                    'fa' => [
                        'title' => 'توسعه Front-End',
                        'issuer_name' => 'W3Schools',
                        'issuer_country' => 'نروژ',
                        'description' => 'گواهینامه‌ای با تمرکز بر مبانی توسعه Front-End شامل HTML، CSS، JavaScript، طراحی واکنش‌گرا و روش‌های مدرن برای ایجاد تجربه‌های وب تعاملی، قابل دسترس و کاربرپسند.',
                    ],

                    'ar' => [
                        'title' => 'تطوير Front-End',
                        'issuer_name' => 'W3Schools',
                        'issuer_country' => 'النرويج',
                        'description' => 'شهادة تركز على أساسيات تطوير Front-End، بما في ذلك HTML وCSS وJavaScript والتصميم المتجاوب والممارسات الحديثة لإنشاء تجارب ويب تفاعلية وسهلة الاستخدام ومتاحة للمستخدمين.',
                    ],
                ],
            ],

            [
                'issue_date' => '2022-08-30',
                'expiration_date' => null,
                'credential_id' => 'JLFV83P9TN2D',
                'credential_url' => 'https://coursera.org/verify/JLFV83P9TN2D',
                'order' => 7,
                'translations' => [
                    'en' => [
                        'title' => 'Introduction to Hardware and Operating Systems',
                        'issuer_name' => 'IBM Skills Network',
                        'issuer_country' => 'United States',
                        'description' => 'Completed an online course authorized by IBM and offered through Coursera, covering fundamental concepts of computer hardware, operating systems, system components, and essential IT infrastructure knowledge.',
                    ],
                    'pt' => [
                        'title' => 'Introdução a Hardware e Sistemas Operacionais',
                        'issuer_name' => 'IBM Skills Network',
                        'issuer_country' => 'Estados Unidos',
                        'description' => 'Concluí um curso online autorizado pela IBM e oferecido pela Coursera, abordando conceitos fundamentais de hardware, sistemas operacionais, componentes de computadores e conhecimentos essenciais de infraestrutura de TI.',
                    ],
                    'es' => [
                        'title' => 'Introducción al Hardware y Sistemas Operativos',
                        'issuer_name' => 'IBM Skills Network',
                        'issuer_country' => 'Estados Unidos',
                        'description' => 'Completé un curso en línea autorizado por IBM y ofrecido a través de Coursera, enfocado en conceptos fundamentales de hardware, sistemas operativos, componentes informáticos e infraestructura de TI.',
                    ],
                    'de' => [
                        'title' => 'Einführung in Hardware und Betriebssysteme',
                        'issuer_name' => 'IBM Skills Network',
                        'issuer_country' => 'Vereinigte Staaten',
                        'description' => 'Abgeschlossener Online-Kurs, der von IBM autorisiert und über Coursera angeboten wurde. Behandelt wurden Grundlagen von Computerhardware, Betriebssystemen, Systemkomponenten und IT-Infrastruktur.',
                    ],
                    'tr' => [
                        'title' => 'Donanım ve İşletim Sistemlerine Giriş',
                        'issuer_name' => 'IBM Skills Network',
                        'issuer_country' => 'Amerika Birleşik Devletleri',
                        'description' => 'IBM tarafından yetkilendirilen ve Coursera üzerinden sunulan çevrim içi kurs tamamlandı. Bilgisayar donanımı, işletim sistemleri, sistem bileşenleri ve temel BT altyapısı konuları ele alındı.',
                    ],
                    'fa' => [
                        'title' => 'مقدمه‌ای بر سخت‌افزار و سیستم‌عامل‌ها',
                        'issuer_name' => 'IBM Skills Network',
                        'issuer_country' => 'ایالات متحده',
                        'description' => 'یک دوره آنلاین تأییدشده توسط IBM و ارائه‌شده از طریق Coursera با موفقیت به پایان رسید. این دوره شامل مفاهیم پایه سخت‌افزار کامپیوتر، سیستم‌عامل‌ها، اجزای سیستم و زیرساخت فناوری اطلاعات بود.',
                    ],
                    'ar' => [
                        'title' => 'مقدمة في الأجهزة وأنظمة التشغيل',
                        'issuer_name' => 'IBM Skills Network',
                        'issuer_country' => 'الولايات المتحدة',
                        'description' => 'تم إكمال دورة تدريبية عبر الإنترنت معتمدة من IBM ومقدمة من خلال Coursera، تغطي أساسيات أجهزة الكمبيوتر وأنظمة التشغيل ومكونات النظام والبنية التحتية لتقنية المعلومات.',
                    ],
                ],
            ],

            [
                'issue_date' => '2022-12-07',
                'expiration_date' => null,
                'credential_id' => 'L4PF8RKA5KNR',
                'credential_url' => 'https://coursera.org/verify/L4PF8RKA5KNR',
                'order' => 8,
                'translations' => [
                    'en' => [
                        'title' => 'Introduction to Git and GitHub',
                        'issuer_name' => 'Google',
                        'issuer_country' => 'United States',
                        'description' => 'Completed an online course authorized by Google and offered through Coursera, covering version control fundamentals, Git workflows, repository management, branching strategies, collaboration practices, and essential GitHub concepts used in modern software development.',
                    ],
                    'pt' => [
                        'title' => 'Introdução ao Git e GitHub',
                        'issuer_name' => 'Google',
                        'issuer_country' => 'Estados Unidos',
                        'description' => 'Concluí um curso online autorizado pelo Google e oferecido pela Coursera, abordando fundamentos de controle de versão, fluxos de trabalho com Git, gerenciamento de repositórios, estratégias de branches, colaboração em equipe e conceitos essenciais do GitHub utilizados no desenvolvimento moderno de software.',
                    ],
                    'es' => [
                        'title' => 'Introducción a Git y GitHub',
                        'issuer_name' => 'Google',
                        'issuer_country' => 'Estados Unidos',
                        'description' => 'Completé un curso en línea autorizado por Google y ofrecido a través de Coursera, enfocado en fundamentos del control de versiones, flujos de trabajo con Git, administración de repositorios, estrategias de ramas, colaboración y conceptos esenciales de GitHub utilizados en el desarrollo moderno de software.',
                    ],
                    'de' => [
                        'title' => 'Einführung in Git und GitHub',
                        'issuer_name' => 'Google',
                        'issuer_country' => 'Vereinigte Staaten',
                        'description' => 'Abgeschlossener Online-Kurs, der von Google autorisiert und über Coursera angeboten wurde. Behandelt wurden Grundlagen der Versionskontrolle, Git-Workflows, Repository-Verwaltung, Branching-Strategien, Zusammenarbeit und wichtige GitHub-Konzepte für die moderne Softwareentwicklung.',
                    ],
                    'tr' => [
                        'title' => 'Git ve GitHub’a Giriş',
                        'issuer_name' => 'Google',
                        'issuer_country' => 'Amerika Birleşik Devletleri',
                        'description' => 'Google tarafından yetkilendirilen ve Coursera üzerinden sunulan çevrim içi kurs tamamlandı. Eğitim kapsamında sürüm kontrolü temelleri, Git iş akışları, depo yönetimi, branch stratejileri, ekip içi iş birliği ve modern yazılım geliştirmede kullanılan temel GitHub kavramları ele alındı.',
                    ],
                    'fa' => [
                        'title' => 'مقدمه‌ای بر Git و GitHub',
                        'issuer_name' => 'Google',
                        'issuer_country' => 'ایالات متحده',
                        'description' => 'یک دوره آنلاین تأییدشده توسط گوگل و ارائه‌شده از طریق Coursera با موفقیت به پایان رسید. این دوره شامل مفاهیم پایه کنترل نسخه، گردش کار Git، مدیریت مخزن، استراتژی‌های شاخه‌بندی، همکاری تیمی و مفاهیم ضروری GitHub در توسعه مدرن نرم‌افزار بود.',
                    ],
                    'ar' => [
                        'title' => 'مقدمة في Git و GitHub',
                        'issuer_name' => 'Google',
                        'issuer_country' => 'الولايات المتحدة',
                        'description' => 'تم إكمال دورة تدريبية عبر الإنترنت معتمدة من Google ومقدمة من خلال Coursera، تغطي أساسيات التحكم بالإصدارات، سير عمل Git، إدارة المستودعات، استراتيجيات الفروع، التعاون الجماعي ومفاهيم GitHub الأساسية المستخدمة في تطوير البرمجيات الحديثة.',
                    ],
                ],
            ],
        ];

        foreach ($certifications as $certification) {
            $translations = $certification['translations'];

            unset($certification['translations']);

            $item = Certification::updateOrCreate(
                [
                    'credential_id' => $certification['credential_id'],
                    'order' => $certification['order'],
                ],
                $certification
            );

            foreach ($translations as $locale => $translation) {
                $language = Language::where('code', $locale)->first();

                if (! $language) {
                    continue;
                }

                $item->translations()->updateOrCreate(
                    [
                        'language_id' => $language->id,
                    ],
                    $translation
                );
            }
        }
    }
}

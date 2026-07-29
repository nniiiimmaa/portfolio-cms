<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'slug' => 'sprinter',
                'project_type_id' => 8,
                'project_status_id' => 4,
                'featured' => false,
                'order' => 1,
                'github_url' => null,
                'live_url' => 'https://sprinter-sistemas.usb.org.br/',
                'technologies' => [
                    'JavaScript',
                    'Vue.js',
                    'Tailwind CSS',
                    'Pinia',
                    'VueUse',
                    'Vue I18n',
                    'Docker',
                    'Laravel',
                    'PrimeVue',
                ],
                'translations' => [
                    'en' => [
                        'title' => 'Sprinter',
                        'description' => 'Sprinter is a Kanban-based project management platform developed to streamline task organization, team collaboration, and workflow management. The front-end was built using Vue.js with a strong emphasis on responsive design, reusable components, and an intuitive user experience. The application incorporates multilingual support, efficient state management with Pinia, reusable composables through VueUse, and seamless integration with a Laravel back end, resulting in a scalable, maintainable, and modern application architecture.',
                    ],
                    'pt' => [
                        'title' => 'Sprinter',
                        'description' => 'Sprinter é uma plataforma de gerenciamento de projetos baseada em Kanban desenvolvida para otimizar a organização de tarefas, a colaboração entre equipes e o fluxo de trabalho. O front-end foi desenvolvido utilizando Vue.js com foco em design responsivo, reutilização de componentes e uma experiência de usuário intuitiva. A aplicação conta com suporte multilíngue, gerenciamento de estado com Pinia, composables reutilizáveis com VueUse e integração com um back-end Laravel, proporcionando uma arquitetura moderna, escalável e de fácil manutenção.',
                    ],
                    'es' => [
                        'title' => 'Sprinter',
                        'description' => 'Sprinter es una plataforma de gestión de proyectos basada en Kanban diseñada para optimizar la organización de tareas, la colaboración entre equipos y los flujos de trabajo. El front-end fue desarrollado con Vue.js, priorizando el diseño responsivo, la reutilización de componentes y una experiencia de usuario intuitiva. Incluye soporte multilingüe, gestión de estado mediante Pinia, composables reutilizables con VueUse e integración con un back-end Laravel, ofreciendo una arquitectura moderna, escalable y mantenible.',
                    ],
                    'de' => [
                        'title' => 'Sprinter',
                        'description' => 'Sprinter ist eine Kanban-basierte Projektmanagement-Plattform zur Optimierung von Aufgabenorganisation, Teamarbeit und Arbeitsabläufen. Das Frontend wurde mit Vue.js entwickelt und legt besonderen Wert auf responsives Design, wiederverwendbare Komponenten und eine intuitive Benutzererfahrung. Mehrsprachige Unterstützung, Zustandsverwaltung mit Pinia, wiederverwendbare Composables durch VueUse sowie die Integration mit einem Laravel-Backend sorgen für eine moderne, skalierbare und wartbare Architektur.',
                    ],
                    'tr' => [
                        'title' => 'Sprinter',
                        'description' => 'Sprinter, görev organizasyonunu, ekip iş birliğini ve iş akışlarını iyileştirmek amacıyla geliştirilen Kanban tabanlı bir proje yönetim platformudur. Ön yüz, Vue.js kullanılarak duyarlı tasarım, yeniden kullanılabilir bileşenler ve kullanıcı deneyimi odaklı olarak geliştirilmiştir. Pinia ile durum yönetimi, VueUse ile yeniden kullanılabilir composable yapıları, çoklu dil desteği ve Laravel arka ucu ile entegrasyon sayesinde modern, ölçeklenebilir ve sürdürülebilir bir mimari sunmaktadır.',
                    ],
                    'fa' => [
                        'title' => 'Sprinter',
                        'description' => 'Sprinter یک پلتفرم مدیریت پروژه مبتنی بر کانبان است که برای بهبود سازماندهی وظایف، همکاری تیمی و مدیریت گردش کار طراحی شده است. رابط کاربری این پروژه با Vue.js توسعه یافته و بر طراحی واکنش‌گرا، استفاده مجدد از کامپوننت‌ها و تجربه کاربری روان تمرکز دارد. پشتیبانی از چند زبان، مدیریت وضعیت با Pinia، استفاده از VueUse و یکپارچگی با بک‌اند Laravel، معماری مدرن، مقیاس‌پذیر و قابل نگهداری را فراهم کرده است.',
                    ],
                    'ar' => [
                        'title' => 'Sprinter',
                        'description' => 'Sprinter هي منصة لإدارة المشاريع تعتمد على نظام كانبان، صُممت لتحسين تنظيم المهام والتعاون بين أعضاء الفريق وسير العمل. تم تطوير الواجهة الأمامية باستخدام Vue.js مع التركيز على التصميم المتجاوب، وإعادة استخدام المكونات، وتجربة مستخدم سلسة. يدعم المشروع تعدد اللغات، وإدارة الحالة باستخدام Pinia، والاستفادة من VueUse، بالإضافة إلى التكامل مع Laravel لتوفير بنية حديثة وقابلة للتوسع وسهلة الصيانة.',
                    ],
                ],
            ],
            [
                'slug' => 'acrm',
                'project_type_id' => 7,
                'project_status_id' => 5,
                'featured' => false,
                'order' => 2,
                'github_url' => null,
                'live_url' => 'https://acrm2.sdasystems.org/login',
                'technologies' => [
                    'JavaScript',
                    'Vue.js',
                    'Tailwind CSS',
                    'Pinia',
                    'VueUse',
                    'Vue I18n',
                    'Docker',
                    'Laravel',
                    'PrimeVue',
                ],
                'translations' => [
                    'en' => [
                        'title' => 'ACRM',
                        'description' => 'Contributed to the front-end development of ACRM, a comprehensive university management platform composed of ten integrated systems supporting enrollment, student services, partnerships, complaints, training, and academic administration. Developed responsive and multilingual interfaces using Vue.js while integrating with a Laravel back end. Focused on component reusability, maintainability, and delivering a consistent user experience across interconnected modules serving educational institutions.',
                    ],
                    'pt' => [
                        'title' => 'ACRM',
                        'description' => 'Contribuí para o desenvolvimento do front-end do ACRM, uma plataforma completa de gestão universitária composta por dez sistemas integrados para matrícula, atendimento ao aluno, parcerias, ouvidoria, treinamentos e administração acadêmica. Desenvolvi interfaces responsivas e multilíngues utilizando Vue.js em integração com um back-end Laravel, priorizando reutilização de componentes, manutenção do código e uma experiência consistente entre todos os módulos da plataforma.',
                    ],
                    'es' => [
                        'title' => 'ACRM',
                        'description' => 'Contribuí al desarrollo del front-end de ACRM, una plataforma integral de gestión universitaria compuesta por diez sistemas integrados para matrículas, atención al estudiante, alianzas, quejas, capacitaciones y administración académica. Desarrollé interfaces responsivas y multilingües con Vue.js integradas con un back-end Laravel, priorizando la reutilización de componentes, la mantenibilidad y una experiencia uniforme entre todos los módulos.',
                    ],
                    'de' => [
                        'title' => 'ACRM',
                        'description' => 'Mitwirkung an der Frontend-Entwicklung von ACRM, einer umfassenden Hochschulverwaltungsplattform mit zehn integrierten Systemen für Einschreibung, Studierendenservice, Partnerschaften, Beschwerden, Schulungen und akademische Verwaltung. Entwicklung responsiver und mehrsprachiger Benutzeroberflächen mit Vue.js in Verbindung mit einem Laravel-Backend, wobei Wiederverwendbarkeit, Wartbarkeit und eine konsistente Benutzererfahrung im Mittelpunkt standen.',
                    ],
                    'tr' => [
                        'title' => 'ACRM',
                        'description' => 'ACRM adlı üniversite yönetim platformunun ön yüz geliştirilmesine katkıda bulunuldu. Platform; kayıt işlemleri, öğrenci hizmetleri, iş birlikleri, şikayet yönetimi, eğitimler ve akademik yönetim dahil olmak üzere on entegre sistemden oluşmaktadır. Vue.js kullanılarak Laravel arka ucu ile entegre, çok dilli ve duyarlı kullanıcı arayüzleri geliştirildi. Bileşenlerin yeniden kullanılabilirliği, sürdürülebilirlik ve tutarlı kullanıcı deneyimi ön planda tutuldu.',
                    ],
                    'fa' => [
                        'title' => 'ACRM',
                        'description' => 'در توسعه رابط کاربری ACRM، یک پلتفرم جامع مدیریت دانشگاهی متشکل از ده سامانه یکپارچه برای ثبت‌نام، خدمات دانشجویی، همکاری‌ها، رسیدگی به شکایات، آموزش‌ها و مدیریت آموزشی مشارکت داشتم. رابط‌های کاربری واکنش‌گرا و چندزبانه با استفاده از Vue.js و در ارتباط با بک‌اند Laravel توسعه داده شدند و تمرکز اصلی بر استفاده مجدد از کامپوننت‌ها، نگهداری آسان کد و ارائه تجربه‌ای یکپارچه در تمامی بخش‌های سامانه بود.',
                    ],
                    'ar' => [
                        'title' => 'ACRM',
                        'description' => 'ساهمت في تطوير الواجهة الأمامية لمنصة ACRM، وهي منصة متكاملة لإدارة الجامعات تتكون من عشرة أنظمة مترابطة تشمل التسجيل، وخدمات الطلاب، والشراكات، والشكاوى، والتدريب، والإدارة الأكاديمية. تم تطوير واجهات مستخدم متجاوبة ومتعددة اللغات باستخدام Vue.js مع التكامل مع Laravel، مع التركيز على إعادة استخدام المكونات، وسهولة الصيانة، وتقديم تجربة مستخدم موحدة عبر جميع أجزاء المنصة.',
                    ],
                ],
            ],
            [
                'slug' => 'portfolio-cms',
                'project_type_id' => 4,
                'project_status_id' => 5,
                'featured' => true,
                'order' => 3,
                'github_url' => 'https://github.com/nniiiimmaa/portfolio-cms',
                'live_url' => 'https://nima.it.com',
                'technologies' => [
                    'JavaScript',
                    'Vue.js',
                    'Inertia.js',
                    'Laravel',
                    'Tailwind CSS',
                    'PrimeVue',
                    'Pinia',
                    'Vue I18n',
                    'Vite',
                    'MySQL',
                    'PrimeVue',
                ],
                'translations' => [
                    'en' => [
                        'title' => 'Portfolio CMS',
                        'description' => 'Designed and developed a fully customizable portfolio content management system from the ground up using Laravel, Vue.js, and Inertia.js. The platform enables complete management of portfolio content, including projects, professional experience, education, certifications, skills, hobbies, testimonials, social links, and contact information through a modern administrative dashboard. The application was built with scalability, maintainability, and multilingual support in mind, featuring role-based administration, reusable components, responsive design, image management, visitor statistics, and a structured architecture that allows new modules and features to be added with ease.',
                    ],
                    'pt' => [
                        'title' => 'Portfolio CMS',
                        'description' => 'Projetei e desenvolvi um sistema de gerenciamento de conteúdo para portfólio totalmente personalizável utilizando Laravel, Vue.js e Inertia.js. A plataforma permite o gerenciamento completo de projetos, experiências profissionais, formação acadêmica, certificações, habilidades, hobbies, depoimentos, redes sociais e informações de contato por meio de um painel administrativo moderno. A aplicação foi construída com foco em escalabilidade, manutenibilidade e suporte multilíngue, incluindo componentes reutilizáveis, design responsivo, gerenciamento de imagens, estatísticas de visitantes e uma arquitetura preparada para futuras expansões.',
                    ],
                    'es' => [
                        'title' => 'Portfolio CMS',
                        'description' => 'Diseñé y desarrollé un sistema de gestión de contenidos para portafolios completamente personalizable utilizando Laravel, Vue.js e Inertia.js. La plataforma permite administrar proyectos, experiencia profesional, formación académica, certificaciones, habilidades, pasatiempos, testimonios, redes sociales e información de contacto desde un moderno panel administrativo. La aplicación fue desarrollada con un enfoque en escalabilidad, mantenibilidad y soporte multilingüe, incorporando componentes reutilizables, diseño adaptable, gestión de imágenes, estadísticas de visitantes y una arquitectura preparada para futuras ampliaciones.',
                    ],
                    'de' => [
                        'title' => 'Portfolio CMS',
                        'description' => 'Entwicklung eines vollständig anpassbaren Portfolio-Content-Management-Systems mit Laravel, Vue.js und Inertia.js. Die Plattform ermöglicht die Verwaltung von Projekten, Berufserfahrung, Ausbildung, Zertifizierungen, Fähigkeiten, Hobbys, Referenzen, sozialen Netzwerken und Kontaktdaten über ein modernes Administrations-Dashboard. Die Anwendung wurde mit Fokus auf Skalierbarkeit, Wartbarkeit und Mehrsprachigkeit entwickelt und umfasst wiederverwendbare Komponenten, responsives Design, Bildverwaltung, Besucherstatistiken und eine erweiterbare Architektur.',
                    ],
                    'tr' => [
                        'title' => 'Portfolio CMS',
                        'description' => 'Laravel, Vue.js ve Inertia.js kullanılarak tamamen özelleştirilebilir bir portföy içerik yönetim sistemi geliştirildi. Platform; projeler, iş deneyimleri, eğitim, sertifikalar, beceriler, hobiler, referanslar, sosyal medya bağlantıları ve iletişim bilgilerinin modern bir yönetim paneli üzerinden yönetilmesini sağlar. Uygulama ölçeklenebilirlik, sürdürülebilirlik ve çoklu dil desteği dikkate alınarak geliştirilmiş olup yeniden kullanılabilir bileşenler, duyarlı tasarım, görsel yönetimi, ziyaretçi istatistikleri ve genişletilebilir bir mimari sunmaktadır.',
                    ],
                    'fa' => [
                        'title' => 'سیستم مدیریت محتوای نمونه‌کار',
                        'description' => 'یک سیستم مدیریت محتوای کاملاً قابل شخصی‌سازی برای نمونه‌کار با استفاده از Laravel، Vue.js و Inertia.js طراحی و توسعه داده شد. این پلتفرم امکان مدیریت کامل پروژه‌ها، سوابق کاری، تحصیلات، گواهینامه‌ها، مهارت‌ها، علایق، نظرات کاربران، شبکه‌های اجتماعی و اطلاعات تماس را از طریق یک پنل مدیریتی مدرن فراهم می‌کند. معماری پروژه با تمرکز بر مقیاس‌پذیری، نگهداری آسان و پشتیبانی از چند زبان طراحی شده و شامل کامپوننت‌های قابل استفاده مجدد، طراحی واکنش‌گرا، مدیریت تصاویر، آمار بازدیدکنندگان و قابلیت توسعه در آینده است.',
                    ],
                    'ar' => [
                        'title' => 'نظام إدارة محتوى معرض الأعمال',
                        'description' => 'تم تصميم وتطوير نظام إدارة محتوى متكامل وقابل للتخصيص بالكامل لمعرض الأعمال باستخدام Laravel وVue.js وInertia.js. يتيح النظام إدارة المشاريع والخبرات المهنية والتعليم والشهادات والمهارات والهوايات والتوصيات وروابط التواصل الاجتماعي وبيانات الاتصال من خلال لوحة تحكم حديثة. تم بناء التطبيق مع التركيز على قابلية التوسع وسهولة الصيانة ودعم تعدد اللغات، ويتضمن مكونات قابلة لإعادة الاستخدام، وتصميماً متجاوباً، وإدارة للصور، وإحصاءات الزوار، وهيكلية مرنة تسمح بإضافة ميزات جديدة بسهولة.',
                    ],
                ],
            ],
            [
                'slug' => 'verboo',
                'project_type_id' => 2,
                'project_status_id' => 4,
                'featured' => false,
                'order' => 4,
                'github_url' => null,
                'live_url' => 'https://7verboo.com.br/',
                'technologies' => [
                    'JavaScript',
                    'Vue.js',
                    'Docker',
                    'PrimeVue',
                ],
                'translations' => [
                    'en' => [
                        'title' => 'Verboo',
                        'description' => 'Developed a modern, responsive landing page with a strong emphasis on visual communication, performance, and user experience. The interface was designed to provide seamless navigation across desktop, tablet, and mobile devices while maintaining consistency in layout, typography, and branding. Built using Vue.js, the project focused on clean component architecture, maintainable code, and fast loading times.',
                    ],
                    'pt' => [
                        'title' => 'Verboo',
                        'description' => 'Desenvolvi uma landing page moderna e responsiva com foco em comunicação visual, desempenho e experiência do usuário. A interface foi projetada para proporcionar uma navegação consistente em desktops, tablets e dispositivos móveis, mantendo a identidade visual e a organização do conteúdo. Desenvolvido com Vue.js, o projeto priorizou uma arquitetura de componentes limpa, código de fácil manutenção e carregamento rápido.',
                    ],
                    'es' => [
                        'title' => 'Verboo',
                        'description' => 'Desarrollé una landing page moderna y responsiva con énfasis en la comunicación visual, el rendimiento y la experiencia del usuario. La interfaz fue diseñada para ofrecer una navegación fluida en computadoras, tabletas y dispositivos móviles, manteniendo una identidad visual consistente. Desarrollado con Vue.js, el proyecto priorizó una arquitectura de componentes limpia, código mantenible y tiempos de carga rápidos.',
                    ],
                    'de' => [
                        'title' => 'Verboo',
                        'description' => 'Entwicklung einer modernen und responsiven Landingpage mit Schwerpunkt auf visueller Kommunikation, Performance und Benutzerfreundlichkeit. Die Oberfläche wurde für eine konsistente Nutzung auf Desktop-, Tablet- und Mobilgeräten optimiert. Das Projekt wurde mit Vue.js umgesetzt und legt Wert auf eine saubere Komponentenarchitektur, wartbaren Code und schnelle Ladezeiten.',
                    ],
                    'tr' => [
                        'title' => 'Verboo',
                        'description' => 'Vue.js kullanılarak modern ve duyarlı bir açılış sayfası geliştirildi. Projede görsel iletişim, performans ve kullanıcı deneyimi ön planda tutulurken masaüstü, tablet ve mobil cihazlarda tutarlı bir kullanım deneyimi sağlandı. Temiz bileşen mimarisi, sürdürülebilir kod yapısı ve hızlı yükleme süreleri hedeflenmiştir.',
                    ],
                    'fa' => [
                        'title' => 'Verboo',
                        'description' => 'یک لندینگ پیج مدرن و واکنش‌گرا با تمرکز بر ارتباط بصری، عملکرد و تجربه کاربری توسعه داده شد. رابط کاربری به گونه‌ای طراحی شد که در رایانه، تبلت و تلفن همراه تجربه‌ای یکپارچه و روان ارائه دهد. این پروژه با Vue.js پیاده‌سازی شده و بر معماری تمیز کامپوننت‌ها، کدنویسی قابل نگهداری و سرعت بارگذاری بالا تمرکز دارد.',
                    ],
                    'ar' => [
                        'title' => 'Verboo',
                        'description' => 'تم تطوير صفحة هبوط حديثة ومتجاوبة مع التركيز على التواصل البصري والأداء وتجربة المستخدم. صُممت الواجهة لتوفير تجربة استخدام متسقة على أجهزة الكمبيوتر والأجهزة اللوحية والهواتف المحمولة مع الحفاظ على هوية بصرية واضحة. تم بناء المشروع باستخدام Vue.js مع التركيز على هيكلية مكونات نظيفة، وسهولة صيانة الكود، وسرعة التحميل.',
                    ],
                ],
            ],
            [
                'slug' => 'ctec',
                'project_type_id' => 5,
                'project_status_id' => 5,
                'featured' => false,
                'order' => 5,
                'github_url' => null,
                'live_url' => 'https://ctec.usb.org.br/',
                'technologies' => [
                    'Vue.js',
                    'Laravel',
                    'Pinia',
                    'VueUse',
                    'Docker',
                    'SQL Server',
                    'PrimeVue',
                ],
                'translations' => [
                    'en' => [
                        'title' => 'C-TEC',
                        'description' => 'Contributed to the development of a full-stack corporate portal that centralizes multiple internal systems into a unified platform. The application includes employee history management, company regulations, document management, and historical archives, providing secure access to organizational information and internal processes. Built within a Laravel and Vue.js ecosystem, the project emphasized scalable architecture, reusable components, efficient state management, and seamless integration with Microsoft SQL Server in a collaborative development environment.',
                    ],
                    'pt' => [
                        'title' => 'C-TEC',
                        'description' => 'Contribuí para o desenvolvimento de um portal corporativo full-stack que centraliza diversos sistemas internos em uma única plataforma. A aplicação inclui gerenciamento do histórico de colaboradores, regulamentos internos, gestão de documentos e arquivos históricos, oferecendo acesso seguro às informações e processos da organização. Desenvolvido com Laravel e Vue.js, o projeto priorizou arquitetura escalável, componentes reutilizáveis, gerenciamento eficiente de estado e integração com Microsoft SQL Server em um ambiente colaborativo.',
                    ],
                    'es' => [
                        'title' => 'C-TEC',
                        'description' => 'Contribuí al desarrollo de un portal corporativo full-stack que centraliza múltiples sistemas internos en una única plataforma. La aplicación incluye la gestión del historial de empleados, reglamentos internos, administración de documentos y archivos históricos, proporcionando acceso seguro a la información y los procesos de la organización. Desarrollado con Laravel y Vue.js, el proyecto priorizó una arquitectura escalable, componentes reutilizables, gestión eficiente del estado e integración con Microsoft SQL Server.',
                    ],
                    'de' => [
                        'title' => 'C-TEC',
                        'description' => 'Mitwirkung an der Entwicklung eines Full-Stack-Unternehmensportals, das mehrere interne Systeme in einer zentralen Plattform vereint. Die Anwendung umfasst Mitarbeiterhistorien, Unternehmensrichtlinien, Dokumentenverwaltung und historische Archive und ermöglicht einen sicheren Zugriff auf Unternehmensinformationen. Das Projekt wurde mit Laravel und Vue.js entwickelt und legt besonderen Wert auf eine skalierbare Architektur, wiederverwendbare Komponenten, effizientes Zustandsmanagement und die Integration mit Microsoft SQL Server.',
                    ],
                    'tr' => [
                        'title' => 'C-TEC',
                        'description' => 'Birden fazla kurumsal sistemi tek bir platformda birleştiren tam kapsamlı bir şirket portalının geliştirilmesine katkıda bulunuldu. Uygulama; çalışan geçmişi yönetimi, şirket yönetmelikleri, belge yönetimi ve tarihsel arşiv modüllerini içermektedir. Laravel ve Vue.js ekosistemi üzerinde geliştirilen projede ölçeklenebilir mimari, yeniden kullanılabilir bileşenler, verimli durum yönetimi ve Microsoft SQL Server entegrasyonu ön planda tutulmuştur.',
                    ],
                    'fa' => [
                        'title' => 'C-TEC',
                        'description' => 'در توسعه یک پرتال سازمانی فول‌استک مشارکت داشتم که چندین سامانه داخلی را در یک پلتفرم یکپارچه گرد هم می‌آورد. این سامانه شامل مدیریت سوابق کارکنان، آیین‌نامه‌های سازمانی، مدیریت اسناد و آرشیوهای تاریخی است و دسترسی امن به اطلاعات و فرایندهای داخلی را فراهم می‌کند. پروژه با استفاده از Laravel و Vue.js توسعه یافته و بر معماری مقیاس‌پذیر، کامپوننت‌های قابل استفاده مجدد، مدیریت بهینه وضعیت و یکپارچگی با Microsoft SQL Server تمرکز دارد.',
                    ],
                    'ar' => [
                        'title' => 'C-TEC',
                        'description' => 'ساهمت في تطوير بوابة مؤسسية متكاملة تجمع عدة أنظمة داخلية ضمن منصة واحدة. تشمل المنصة إدارة سجلات الموظفين، ولوائح الشركة، وإدارة المستندات، والأرشيفات التاريخية، مما يوفر وصولاً آمناً إلى معلومات المؤسسة وعملياتها الداخلية. تم تطوير المشروع باستخدام Laravel وVue.js مع التركيز على بنية قابلة للتوسع، ومكونات قابلة لإعادة الاستخدام، وإدارة فعالة للحالة، والتكامل مع Microsoft SQL Server.',
                    ],
                ],
            ],
            [
                'slug' => 'dental-hope',
                'project_type_id' => 1,
                'project_status_id' => 5,
                'featured' => false,
                'order' => 6,
                'github_url' => null,
                'live_url' => 'https://dentalhope.usb.org.br/',
                'technologies' => [
                    'Vue.js',
                    'Pinia',
                    'PrimeVue',
                    'Tailwind CSS',
                ],
                'translations' => [
                    'en' => [
                        'title' => 'Dental Hope',
                        'description' => 'Contributed to the front-end development of Dental Hope, a dentist locator platform developed for Dental Uni. The application enables users to search for partnered dental professionals through a responsive, intuitive, and user-friendly interface. Built with Vue.js, the project focused on accessibility, responsive design, reusable components, and efficient state management to provide a seamless experience across desktop and mobile devices.',
                    ],
                    'pt' => [
                        'title' => 'Dental Hope',
                        'description' => 'Contribuí para o desenvolvimento do front-end do Dental Hope, uma plataforma de busca de dentistas desenvolvida para a Dental Uni. A aplicação permite que os usuários encontrem profissionais parceiros por meio de uma interface responsiva, intuitiva e de fácil utilização. Desenvolvido com Vue.js, o projeto priorizou acessibilidade, design responsivo, componentes reutilizáveis e gerenciamento eficiente de estado para proporcionar uma experiência consistente em computadores e dispositivos móveis.',
                    ],
                    'es' => [
                        'title' => 'Dental Hope',
                        'description' => 'Contribuí al desarrollo del front-end de Dental Hope, una plataforma de búsqueda de odontólogos desarrollada para Dental Uni. La aplicación permite a los usuarios encontrar profesionales asociados mediante una interfaz responsiva, intuitiva y fácil de usar. Desarrollada con Vue.js, el proyecto priorizó la accesibilidad, el diseño adaptable, los componentes reutilizables y una gestión eficiente del estado para ofrecer una experiencia fluida en computadoras y dispositivos móviles.',
                    ],
                    'de' => [
                        'title' => 'Dental Hope',
                        'description' => 'Mitwirkung an der Frontend-Entwicklung von Dental Hope, einer Zahnarztsuchplattform für Dental Uni. Die Anwendung ermöglicht es Benutzern, Partnerzahnärzte über eine responsive und intuitive Benutzeroberfläche zu finden. Das Projekt wurde mit Vue.js entwickelt und legt besonderen Wert auf Barrierefreiheit, responsives Design, wiederverwendbare Komponenten und effizientes Zustandsmanagement.',
                    ],
                    'tr' => [
                        'title' => 'Dental Hope',
                        'description' => 'Dental Uni için geliştirilen Dental Hope diş hekimi bulma platformunun ön yüz geliştirilmesine katkıda bulunuldu. Uygulama, kullanıcıların anlaşmalı diş hekimlerini duyarlı ve kullanıcı dostu bir arayüz üzerinden kolayca bulmasını sağlamaktadır. Vue.js kullanılarak geliştirilen projede erişilebilirlik, yeniden kullanılabilir bileşenler, duyarlı tasarım ve verimli durum yönetimi ön planda tutulmuştur.',
                    ],
                    'fa' => [
                        'title' => 'Dental Hope',
                        'description' => 'در توسعه رابط کاربری Dental Hope، پلتفرم جستجوی دندانپزشکان برای مجموعه Dental Uni، مشارکت داشتم. این سامانه به کاربران امکان می‌دهد دندانپزشکان همکار را از طریق رابطی واکنش‌گرا، ساده و کاربرپسند جستجو و پیدا کنند. پروژه با Vue.js توسعه یافته و بر دسترس‌پذیری، طراحی واکنش‌گرا، کامپوننت‌های قابل استفاده مجدد و مدیریت بهینه وضعیت تمرکز دارد.',
                    ],
                    'ar' => [
                        'title' => 'Dental Hope',
                        'description' => 'ساهمت في تطوير الواجهة الأمامية لمنصة Dental Hope، وهي منصة للبحث عن أطباء الأسنان تم تطويرها لصالح Dental Uni. تتيح المنصة للمستخدمين العثور على أطباء الأسنان الشركاء من خلال واجهة متجاوبة وسهلة الاستخدام. تم تطوير المشروع باستخدام Vue.js مع التركيز على سهولة الوصول، والتصميم المتجاوب، والمكونات القابلة لإعادة الاستخدام، والإدارة الفعالة للحالة.',
                    ],
                ],
            ],
            [
                'slug' => 'agat',
                'project_type_id' => 7,
                'project_status_id' => 5,
                'featured' => false,
                'order' => 7,
                'github_url' => null,
                'live_url' => 'https://agat.faculdadeadventista.edu.br',
                'technologies' => [
                    'Vue.js',
                    'Laravel',
                    'PrimeVue',
                    'Tailwind CSS',
                    'Microsoft SQL Server',
                    'Docker',
                ],
                'translations' => [
                    'en' => [
                        'title' => 'Agat',
                        'description' => 'Contributed to the development of Agat, an academic management system designed to simplify semester administration for higher education institutions. The platform enables faculty members to manage student enrollment in academic activities through an intuitive and efficient interface. Built with Vue.js, Laravel, Microsoft SQL Server, and Docker, the application emphasizes scalability, maintainability, and reliable data management while supporting institutional academic workflows.',
                    ],
                    'pt' => [
                        'title' => 'Agat',
                        'description' => 'Contribuí para o desenvolvimento do Agat, um sistema de gestão acadêmica desenvolvido para simplificar a administração semestral em instituições de ensino superior. A plataforma permite que docentes gerenciem a matrícula de estudantes em atividades acadêmicas por meio de uma interface intuitiva e eficiente. Desenvolvido com Vue.js, Laravel, Microsoft SQL Server e Docker, o sistema prioriza escalabilidade, manutenibilidade e gerenciamento confiável de dados para apoiar os processos acadêmicos da instituição.',
                    ],
                    'es' => [
                        'title' => 'Agat',
                        'description' => 'Contribuí al desarrollo de Agat, un sistema de gestión académica diseñado para simplificar la administración semestral en instituciones de educación superior. La plataforma permite a los docentes gestionar la inscripción de estudiantes en actividades académicas mediante una interfaz intuitiva y eficiente. Desarrollado con Vue.js, Laravel, Microsoft SQL Server y Docker, el sistema prioriza la escalabilidad, la mantenibilidad y una gestión confiable de los datos.',
                    ],
                    'de' => [
                        'title' => 'Agat',
                        'description' => 'Mitwirkung an der Entwicklung von Agat, einem akademischen Verwaltungssystem zur Vereinfachung semesterbezogener Prozesse an Hochschulen. Die Plattform ermöglicht Lehrkräften die Verwaltung der Studierendenzuordnung zu akademischen Aktivitäten über eine intuitive Benutzeroberfläche. Entwickelt mit Vue.js, Laravel, Microsoft SQL Server und Docker, legt das System besonderen Wert auf Skalierbarkeit, Wartbarkeit und zuverlässige Datenverwaltung.',
                    ],
                    'tr' => [
                        'title' => 'Agat',
                        'description' => 'Agat, yükseköğretim kurumlarının dönemsel akademik süreçlerini kolaylaştırmak amacıyla geliştirilen bir akademik yönetim sistemidir. Platform, öğretim üyelerinin öğrencileri akademik etkinliklere kolayca ekleyip çıkarabilmesini sağlayan sezgisel bir arayüz sunmaktadır. Vue.js, Laravel, Microsoft SQL Server ve Docker kullanılarak geliştirilen proje; ölçeklenebilirlik, sürdürülebilirlik ve güvenilir veri yönetimi odaklıdır.',
                    ],
                    'fa' => [
                        'title' => 'Agat',
                        'description' => 'در توسعه Agat، یک سیستم مدیریت آموزشی برای ساده‌سازی فرایندهای نیمسال تحصیلی در مؤسسات آموزش عالی، مشارکت داشتم. این سامانه به اعضای هیئت علمی امکان می‌دهد دانشجویان را به فعالیت‌های آموزشی اضافه یا از آن‌ها حذف کنند. پروژه با استفاده از Vue.js، Laravel، Microsoft SQL Server و Docker توسعه یافته و بر مقیاس‌پذیری، نگهداری آسان و مدیریت مطمئن داده‌ها تمرکز دارد.',
                    ],
                    'ar' => [
                        'title' => 'Agat',
                        'description' => 'ساهمت في تطوير Agat، وهو نظام لإدارة الشؤون الأكاديمية يهدف إلى تبسيط إدارة الفصول الدراسية في مؤسسات التعليم العالي. تتيح المنصة لأعضاء هيئة التدريس إدارة تسجيل الطلاب في الأنشطة الأكاديمية من خلال واجهة سهلة وفعالة. تم تطوير المشروع باستخدام Vue.js وLaravel وMicrosoft SQL Server وDocker مع التركيز على قابلية التوسع وسهولة الصيانة والإدارة الموثوقة للبيانات.',
                    ],
                ],
            ],
        ];

        foreach ($projects as $project) {
            $translations = $project['translations'];

            unset($project['translations']);

            $newProject = Project::updateOrCreate(
                [
                    'slug' => $project['slug'],
                ],
                $project
            );

            foreach ($translations as $locale => $translation) {
                $language = Language::where('code', $locale)->first();

                if (! $language) {
                    continue;
                }

                $newProject->translations()->updateOrCreate(
                    [
                        'language_id' => $language->id,
                    ],
                    [
                        'title' => $translation['title'],
                        'description' => $translation['description'],
                    ]
                );
            }
        }
    }
}

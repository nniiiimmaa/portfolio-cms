<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [

            // -----------------------------------------------------------------
            // Front-End Development (Category ID: 1)
            // -----------------------------------------------------------------

            [
                'skill_category_id' => 1,
                'slug' => 'html5',
                'icon' => 'html',
                'level' => 100,
                'years_experience' => 5,
                'featured' => true,
                'order' => 1,
                'translations' => [
                    'en' => ['name' => 'HTML5', 'description' => 'Semantic and accessible HTML5 markup for modern web applications.'],
                    'pt' => ['name' => 'HTML5', 'description' => 'Marcação HTML5 semântica e acessível para aplicações web modernas.'],
                    'es' => ['name' => 'HTML5', 'description' => 'Marcado HTML5 semántico y accesible para aplicaciones web modernas.'],
                    'de' => ['name' => 'HTML5', 'description' => 'Semantisches und barrierefreies HTML5 für moderne Webanwendungen.'],
                    'tr' => ['name' => 'HTML5', 'description' => 'Modern web uygulamaları için semantik ve erişilebilir HTML5.'],
                    'fa' => ['name' => 'HTML5', 'description' => 'استفاده از HTML5 معنایی و دسترس‌پذیر برای برنامه‌های مدرن وب.'],
                    'ar' => ['name' => 'HTML5', 'description' => 'استخدام HTML5 الدلالي والمتوافق مع معايير إمكانية الوصول لتطبيقات الويب الحديثة.'],
                ],
            ],

            [
                'skill_category_id' => 1,
                'slug' => 'css3',
                'icon' => 'css',
                'level' => 90,
                'years_experience' => 5,
                'featured' => true,
                'order' => 2,
                'translations' => [
                    'en' => ['name' => 'CSS3', 'description' => 'Modern CSS including Flexbox, Grid, animations, and responsive layouts.'],
                    'pt' => ['name' => 'CSS3', 'description' => 'CSS moderno incluindo Flexbox, Grid, animações e layouts responsivos.'],
                    'es' => ['name' => 'CSS3', 'description' => 'CSS moderno con Flexbox, Grid, animaciones y diseños responsivos.'],
                    'de' => ['name' => 'CSS3', 'description' => 'Modernes CSS mit Flexbox, Grid, Animationen und responsiven Layouts.'],
                    'tr' => ['name' => 'CSS3', 'description' => 'Flexbox, Grid, animasyonlar ve duyarlı tasarımlar içeren modern CSS.'],
                    'fa' => ['name' => 'CSS3', 'description' => 'CSS مدرن شامل Flexbox، Grid، انیمیشن‌ها و طراحی واکنش‌گرا.'],
                    'ar' => ['name' => 'CSS3', 'description' => 'CSS حديث يشمل Flexbox وGrid والرسوم المتحركة والتصميم المتجاوب.'],
                ],
            ],

            [
                'skill_category_id' => 1,
                'slug' => 'javascript',
                'icon' => 'javascript',
                'level' => 85,
                'years_experience' => 5,
                'featured' => true,
                'order' => 3,
                'translations' => [
                    'en' => ['name' => 'JavaScript', 'description' => 'Building interactive, maintainable, and scalable front-end applications using modern JavaScript.'],
                    'pt' => ['name' => 'JavaScript', 'description' => 'Desenvolvimento de aplicações front-end interativas, escaláveis e de fácil manutenção com JavaScript moderno.'],
                    'es' => ['name' => 'JavaScript', 'description' => 'Desarrollo de aplicaciones front-end interactivas y escalables con JavaScript moderno.'],
                    'de' => ['name' => 'JavaScript', 'description' => 'Entwicklung interaktiver und skalierbarer Frontend-Anwendungen mit modernem JavaScript.'],
                    'tr' => ['name' => 'JavaScript', 'description' => 'Modern JavaScript ile etkileşimli ve ölçeklenebilir ön yüz uygulamaları geliştirme.'],
                    'fa' => ['name' => 'JavaScript', 'description' => 'توسعه برنامه‌های تعاملی و مقیاس‌پذیر با JavaScript مدرن.'],
                    'ar' => ['name' => 'JavaScript', 'description' => 'تطوير تطبيقات واجهات أمامية تفاعلية وقابلة للتوسع باستخدام JavaScript الحديثة.'],
                ],
            ],

            [
                'skill_category_id' => 1,
                'slug' => 'vue-js',
                'icon' => 'vue',
                'level' => 85,
                'years_experience' => 4,
                'featured' => true,
                'order' => 4,
                'translations' => [
                    'en' => ['name' => 'Vue.js', 'description' => 'Building modern SPA applications using the Vue ecosystem and component-based architecture.'],
                    'pt' => ['name' => 'Vue.js', 'description' => 'Desenvolvimento de SPAs modernas utilizando Vue.js e arquitetura baseada em componentes.'],
                    'es' => ['name' => 'Vue.js', 'description' => 'Desarrollo de aplicaciones SPA modernas utilizando Vue.js y arquitectura basada en componentes.'],
                    'de' => ['name' => 'Vue.js', 'description' => 'Entwicklung moderner Single-Page-Anwendungen mit Vue.js und komponentenbasierter Architektur.'],
                    'tr' => ['name' => 'Vue.js', 'description' => 'Vue.js ve bileşen tabanlı mimari ile modern SPA geliştirme.'],
                    'fa' => ['name' => 'Vue.js', 'description' => 'توسعه برنامه‌های تک‌صفحه‌ای مدرن با Vue.js و معماری مبتنی بر کامپوننت.'],
                    'ar' => ['name' => 'Vue.js', 'description' => 'تطوير تطبيقات SPA حديثة باستخدام Vue.js وبنية تعتمد على المكونات.'],
                ],
            ],

            [
                'skill_category_id' => 1,
                'slug' => 'tailwind-css',
                'icon' => null,
                'level' => 85,
                'years_experience' => 3,
                'featured' => true,
                'order' => 5,
                'translations' => [
                    'en' => ['name' => 'Tailwind CSS', 'description' => 'Utility-first CSS framework for modern responsive interfaces.'],
                    'pt' => ['name' => 'Tailwind CSS', 'description' => 'Framework CSS utilitário para interfaces modernas e responsivas.'],
                    'es' => ['name' => 'Tailwind CSS', 'description' => 'Framework CSS utilitario para interfaces modernas y responsivas.'],
                    'de' => ['name' => 'Tailwind CSS', 'description' => 'Utility-First-CSS-Framework für moderne Benutzeroberflächen.'],
                    'tr' => ['name' => 'Tailwind CSS', 'description' => 'Modern arayüzler için utility-first CSS frameworkü.'],
                    'fa' => ['name' => 'Tailwind CSS', 'description' => 'فریم‌ورک Utility-First برای طراحی رابط‌های مدرن.'],
                    'ar' => ['name' => 'Tailwind CSS', 'description' => 'إطار CSS يعتمد على Utility-First لبناء واجهات حديثة.'],
                ],
            ],

            [
                'skill_category_id' => 1,
                'slug' => 'scss',
                'icon' => 'palette',
                'level' => 70,
                'years_experience' => 2,
                'featured' => false,
                'order' => 6,
                'translations' => [
                    'en' => ['name' => 'SCSS', 'description' => 'Writing maintainable and modular stylesheets using SCSS features such as variables, mixins, nesting, and reusable styling patterns.'],
                    'pt' => ['name' => 'SCSS', 'description' => 'Desenvolvimento de folhas de estilo modulares e reutilizáveis utilizando variáveis, mixins, aninhamento e outros recursos do SCSS.'],
                    'es' => ['name' => 'SCSS', 'description' => 'Desarrollo de hojas de estilo modulares y reutilizables utilizando variables, mixins, anidamiento y otras funcionalidades de SCSS.'],
                    'de' => ['name' => 'SCSS', 'description' => 'Entwicklung modularer und wartbarer Stylesheets mit Variablen, Mixins, Verschachtelung und weiteren SCSS-Funktionen.'],
                    'tr' => ['name' => 'SCSS', 'description' => 'Değişkenler, mixinler, iç içe yapı ve yeniden kullanılabilir stil kalıplarıyla modüler SCSS geliştirme.'],
                    'fa' => ['name' => 'SCSS', 'description' => 'توسعه استایل‌های ماژولار و قابل نگهداری با استفاده از متغیرها، میکسین‌ها، تو در تویی و سایر قابلیت‌های SCSS.'],
                    'ar' => ['name' => 'SCSS', 'description' => 'تطوير ملفات أنماط قابلة للصيانة وإعادة الاستخدام باستخدام المتغيرات وMixins والتداخل وميزات SCSS الأخرى.'],
                ],
            ],

            [
                'skill_category_id' => 1,
                'slug' => 'postcss',
                'icon' => 'tune',
                'level' => 30,
                'years_experience' => 1,
                'featured' => false,
                'order' => 7,
                'translations' => [
                    'en' => ['name' => 'PostCSS', 'description' => 'Using PostCSS to automate CSS processing, optimize stylesheets, and integrate modern CSS features into development workflows.'],
                    'pt' => ['name' => 'PostCSS', 'description' => 'Utilização do PostCSS para automatizar o processamento de CSS, otimizar folhas de estilo e integrar recursos modernos ao fluxo de desenvolvimento.'],
                    'es' => ['name' => 'PostCSS', 'description' => 'Uso de PostCSS para automatizar el procesamiento de CSS, optimizar hojas de estilo e integrar funcionalidades modernas al flujo de desarrollo.'],
                    'de' => ['name' => 'PostCSS', 'description' => 'Einsatz von PostCSS zur Automatisierung der CSS-Verarbeitung, Optimierung von Stylesheets und Integration moderner CSS-Funktionen.'],
                    'tr' => ['name' => 'PostCSS', 'description' => 'CSS işleme süreçlerini otomatikleştirmek, stilleri optimize etmek ve modern CSS özelliklerini entegre etmek için PostCSS kullanımı.'],
                    'fa' => ['name' => 'PostCSS', 'description' => 'استفاده از PostCSS برای خودکارسازی پردازش CSS، بهینه‌سازی استایل‌ها و استفاده از قابلیت‌های مدرن CSS.'],
                    'ar' => ['name' => 'PostCSS', 'description' => 'استخدام PostCSS لأتمتة معالجة CSS وتحسين ملفات الأنماط ودمج ميزات CSS الحديثة ضمن سير العمل.'],
                ],
            ],

            // -----------------------------------------------------------------
            // Back-End Development (Category ID: 2)
            // -----------------------------------------------------------------

            [
                'skill_category_id' => 2,
                'slug' => 'laravel',
                'icon' => 'laravel',
                'level' => 80,
                'years_experience' => 4,
                'featured' => false,
                'order' => 1,
                'translations' => [
                    'en' => ['name' => 'Laravel', 'description' => 'Developing scalable web applications and REST APIs using the Laravel framework.'],
                    'pt' => ['name' => 'Laravel', 'description' => 'Desenvolvimento de aplicações web escaláveis e APIs REST com Laravel.'],
                    'es' => ['name' => 'Laravel', 'description' => 'Desarrollo de aplicaciones web escalables y APIs REST con Laravel.'],
                    'de' => ['name' => 'Laravel', 'description' => 'Entwicklung skalierbarer Webanwendungen und REST-APIs mit Laravel.'],
                    'tr' => ['name' => 'Laravel', 'description' => 'Laravel ile ölçeklenebilir web uygulamaları ve REST API geliştirme.'],
                    'fa' => ['name' => 'Laravel', 'description' => 'توسعه برنامه‌های وب و APIهای REST با Laravel.'],
                    'ar' => ['name' => 'Laravel', 'description' => 'تطوير تطبيقات ويب وواجهات REST API باستخدام Laravel.'],
                ],
            ],

            [
                'skill_category_id' => 2,
                'slug' => 'php',
                'icon' => 'php',
                'level' => 60,
                'years_experience' => 4,
                'featured' => false,
                'order' => 2,
                'translations' => [
                    'en' => ['name' => 'PHP', 'description' => 'Server-side development using modern PHP and object-oriented programming principles.'],
                    'pt' => ['name' => 'PHP', 'description' => 'Desenvolvimento back-end utilizando PHP moderno e programação orientada a objetos.'],
                    'es' => ['name' => 'PHP', 'description' => 'Desarrollo back-end utilizando PHP moderno y programación orientada a objetos.'],
                    'de' => ['name' => 'PHP', 'description' => 'Serverseitige Entwicklung mit modernem PHP und OOP.'],
                    'tr' => ['name' => 'PHP', 'description' => 'Modern PHP ve nesne yönelimli programlama ile geliştirme.'],
                    'fa' => ['name' => 'PHP', 'description' => 'توسعه سمت سرور با PHP مدرن و برنامه‌نویسی شیءگرا.'],
                    'ar' => ['name' => 'PHP', 'description' => 'تطوير الخوادم باستخدام PHP الحديث والبرمجة كائنية التوجه.'],
                ],
            ],

            [
                'skill_category_id' => 2,
                'slug' => 'rest-api',
                'icon' => 'api',
                'level' => 70,
                'years_experience' => 4,
                'featured' => false,
                'order' => 3,
                'translations' => [
                    'en' => ['name' => 'REST API Development', 'description' => 'Designing and integrating RESTful APIs for web applications.'],
                    'pt' => ['name' => 'Desenvolvimento de APIs REST', 'description' => 'Desenvolvimento e integração de APIs RESTful.'],
                    'es' => ['name' => 'Desarrollo de APIs REST', 'description' => 'Desarrollo e integración de APIs RESTful.'],
                    'de' => ['name' => 'REST-API-Entwicklung', 'description' => 'Entwicklung und Integration von RESTful APIs.'],
                    'tr' => ['name' => 'REST API Geliştirme', 'description' => 'RESTful API geliştirme ve entegrasyonu.'],
                    'fa' => ['name' => 'توسعه REST API', 'description' => 'طراحی و پیاده‌سازی RESTful API.'],
                    'ar' => ['name' => 'تطوير REST API', 'description' => 'تصميم وتكامل واجهات RESTful API.'],
                ],
            ],

            // -----------------------------------------------------------------
            // Databases (Category ID: 3)
            // -----------------------------------------------------------------

            [
                'skill_category_id' => 3,
                'slug' => 'mysql',
                'icon' => 'database',
                'level' => 80,
                'years_experience' => 4,
                'featured' => false,
                'order' => 1,
                'translations' => [
                    'en' => ['name' => 'MySQL', 'description' => 'Designing relational databases, writing efficient SQL queries, and optimizing data models for Laravel applications.'],
                    'pt' => ['name' => 'MySQL', 'description' => 'Modelagem de bancos relacionais, criação de consultas SQL e otimização para aplicações Laravel.'],
                    'es' => ['name' => 'MySQL', 'description' => 'Diseño de bases de datos relacionales, consultas SQL y optimización para aplicaciones Laravel.'],
                    'de' => ['name' => 'MySQL', 'description' => 'Entwicklung relationaler Datenbanken, SQL-Abfragen und Optimierung für Laravel-Anwendungen.'],
                    'tr' => ['name' => 'MySQL', 'description' => 'Laravel projeleri için ilişkisel veritabanı tasarımı ve SQL optimizasyonu.'],
                    'fa' => ['name' => 'MySQL', 'description' => 'طراحی پایگاه داده‌های رابطه‌ای، نوشتن کوئری‌های SQL و بهینه‌سازی برای پروژه‌های Laravel.'],
                    'ar' => ['name' => 'MySQL', 'description' => 'تصميم قواعد البيانات العلائقية وكتابة استعلامات SQL وتحسينها لتطبيقات Laravel.'],
                ],
            ],

            [
                'skill_category_id' => 3,
                'slug' => 'microsoft-sql-server',
                'icon' => 'storage',
                'level' => 60,
                'years_experience' => 4,
                'featured' => false,
                'order' => 2,
                'translations' => [
                    'en' => ['name' => 'Microsoft SQL Server', 'description' => 'Working with SQL Server databases for enterprise applications, including querying, schema management, and integration with Laravel.'],
                    'pt' => ['name' => 'Microsoft SQL Server', 'description' => 'Utilização do SQL Server em aplicações corporativas com consultas, modelagem e integração com Laravel.'],
                    'es' => ['name' => 'Microsoft SQL Server', 'description' => 'Uso de SQL Server en aplicaciones empresariales con consultas, modelado e integración con Laravel.'],
                    'de' => ['name' => 'Microsoft SQL Server', 'description' => 'Arbeit mit SQL Server für Unternehmensanwendungen einschließlich Datenmodellierung und Integration.'],
                    'tr' => ['name' => 'Microsoft SQL Server', 'description' => 'Kurumsal uygulamalarda SQL Server veritabanlarıyla çalışma.'],
                    'fa' => ['name' => 'Microsoft SQL Server', 'description' => 'کار با پایگاه داده SQL Server در پروژه‌های سازمانی و یکپارچه‌سازی با Laravel.'],
                    'ar' => ['name' => 'Microsoft SQL Server', 'description' => 'العمل مع قواعد بيانات Microsoft SQL Server في التطبيقات المؤسسية.'],
                ],
            ],

            [
                'skill_category_id' => 3,
                'slug' => 'database-design',
                'icon' => 'schema',
                'level' => 50,
                'years_experience' => 2,
                'featured' => false,
                'order' => 3,
                'translations' => [
                    'en' => ['name' => 'Database Design', 'description' => 'Designing normalized database schemas, relationships, migrations, constraints, and scalable data structures.'],
                    'pt' => ['name' => 'Modelagem de Banco de Dados', 'description' => 'Modelagem de bancos normalizados, relacionamentos, migrations e estruturas escaláveis.'],
                    'es' => ['name' => 'Diseño de Bases de Datos', 'description' => 'Diseño de esquemas normalizados, relaciones y estructuras escalables.'],
                    'de' => ['name' => 'Datenbankdesign', 'description' => 'Entwurf normalisierter Datenbankschemata und skalierbarer Datenstrukturen.'],
                    'tr' => ['name' => 'Veritabanı Tasarımı', 'description' => 'Normalize veritabanı şemaları ve ölçeklenebilir veri yapıları tasarlama.'],
                    'fa' => ['name' => 'طراحی پایگاه داده', 'description' => 'طراحی ساختارهای نرمال، روابط و معماری مقیاس‌پذیر پایگاه داده.'],
                    'ar' => ['name' => 'تصميم قواعد البيانات', 'description' => 'تصميم مخططات قواعد بيانات مترابطة وقابلة للتوسع.'],
                ],
            ],

            // -----------------------------------------------------------------
            // DevOps & Tools (Category ID: 4)
            // -----------------------------------------------------------------

            [
                'skill_category_id' => 4,
                'slug' => 'git',
                'icon' => 'commit',
                'level' => 80,
                'years_experience' => 5,
                'featured' => false,
                'order' => 1,
                'translations' => [
                    'en' => ['name' => 'Git', 'description' => 'Version control using branching strategies, collaboration workflows, and source code management.'],
                    'pt' => ['name' => 'Git', 'description' => 'Controle de versão utilizando estratégias de branch e colaboração em equipe.'],
                    'es' => ['name' => 'Git', 'description' => 'Control de versiones mediante ramas y flujos colaborativos.'],
                    'de' => ['name' => 'Git', 'description' => 'Versionskontrolle mit Branching-Strategien und Teamarbeit.'],
                    'tr' => ['name' => 'Git', 'description' => 'Branch yönetimi ve ekip iş akışlarıyla sürüm kontrolü.'],
                    'fa' => ['name' => 'Git', 'description' => 'کنترل نسخه با استفاده از شاخه‌بندی و همکاری تیمی.'],
                    'ar' => ['name' => 'Git', 'description' => 'التحكم في الإصدارات باستخدام الفروع وأساليب التعاون الجماعي.'],
                ],
            ],

            [
                'skill_category_id' => 4,
                'slug' => 'github',
                'icon' => 'code',
                'level' => 85,
                'years_experience' => 5,
                'featured' => false,
                'order' => 2,
                'translations' => [
                    'en' => ['name' => 'GitHub', 'description' => 'Managing repositories, pull requests, code reviews, issues, and collaborative software development.'],
                    'pt' => ['name' => 'GitHub', 'description' => 'Gerenciamento de repositórios, Pull Requests e revisão de código.'],
                    'es' => ['name' => 'GitHub', 'description' => 'Administración de repositorios, Pull Requests y revisiones de código.'],
                    'de' => ['name' => 'GitHub', 'description' => 'Verwaltung von Repositories, Pull Requests und Code-Reviews.'],
                    'tr' => ['name' => 'GitHub', 'description' => 'Depolar, Pull Request süreçleri ve kod incelemeleri yönetimi.'],
                    'fa' => ['name' => 'GitHub', 'description' => 'مدیریت مخازن، Pull Request و بازبینی کد.'],
                    'ar' => ['name' => 'GitHub', 'description' => 'إدارة المستودعات وطلبات الدمج ومراجعات الشفرة البرمجية.'],
                ],
            ],

            [
                'skill_category_id' => 4,
                'slug' => 'docker',
                'icon' => 'deployed_code',
                'level' => 40,
                'years_experience' => 3,
                'featured' => false,
                'order' => 3,
                'translations' => [
                    'en' => ['name' => 'Docker', 'description' => 'Working with containerized development environments for consistent deployment and collaboration.'],
                    'pt' => ['name' => 'Docker', 'description' => 'Utilização de containers para ambientes de desenvolvimento consistentes.'],
                    'es' => ['name' => 'Docker', 'description' => 'Uso de contenedores para entornos de desarrollo consistentes.'],
                    'de' => ['name' => 'Docker', 'description' => 'Containerisierte Entwicklungsumgebungen für konsistente Bereitstellung.'],
                    'tr' => ['name' => 'Docker', 'description' => 'Container tabanlı geliştirme ortamlarıyla çalışma.'],
                    'fa' => ['name' => 'Docker', 'description' => 'استفاده از Docker برای ایجاد محیط‌های توسعه یکپارچه و قابل حمل.'],
                    'ar' => ['name' => 'Docker', 'description' => 'استخدام Docker لإنشاء بيئات تطوير موحدة وقابلة للنقل.'],
                ],
            ],

            [
                'skill_category_id' => 4,
                'slug' => 'npm',
                'icon' => 'package_2',
                'level' => 60,
                'years_experience' => 3,
                'featured' => false,
                'order' => 4,
                'translations' => [
                    'en' => ['name' => 'NPM', 'description' => 'Managing JavaScript packages, dependencies, scripts, and project automation.'],
                    'pt' => ['name' => 'NPM', 'description' => 'Gerenciamento de pacotes, dependências e scripts JavaScript.'],
                    'es' => ['name' => 'NPM', 'description' => 'Gestión de paquetes, dependencias y scripts de JavaScript.'],
                    'de' => ['name' => 'NPM', 'description' => 'Verwaltung von JavaScript-Paketen und Abhängigkeiten.'],
                    'tr' => ['name' => 'NPM', 'description' => 'JavaScript paketleri ve bağımlılık yönetimi.'],
                    'fa' => ['name' => 'NPM', 'description' => 'مدیریت بسته‌ها، وابستگی‌ها و اسکریپت‌های JavaScript.'],
                    'ar' => ['name' => 'NPM', 'description' => 'إدارة حزم JavaScript والتبعيات والبرامج النصية.'],
                ],
            ],

            [
                'skill_category_id' => 4,
                'slug' => 'vite',
                'icon' => 'bolt',
                'level' => 70,
                'years_experience' => 3,
                'featured' => false,
                'order' => 5,
                'translations' => [
                    'en' => ['name' => 'Vite', 'description' => 'Using Vite for modern front-end development, fast builds, and optimized production bundles.'],
                    'pt' => ['name' => 'Vite', 'description' => 'Uso do Vite para desenvolvimento moderno, builds rápidas e otimização de produção.'],
                    'es' => ['name' => 'Vite', 'description' => 'Uso de Vite para desarrollo moderno, compilaciones rápidas y optimización.'],
                    'de' => ['name' => 'Vite', 'description' => 'Verwendung von Vite für moderne Frontend-Entwicklung und schnelle Builds.'],
                    'tr' => ['name' => 'Vite', 'description' => 'Modern ön yüz geliştirme ve hızlı derlemeler için Vite kullanımı.'],
                    'fa' => ['name' => 'Vite', 'description' => 'استفاده از Vite برای توسعه مدرن فرانت‌اند و ساخت سریع پروژه‌ها.'],
                    'ar' => ['name' => 'Vite', 'description' => 'استخدام Vite لتطوير الواجهات الحديثة وسرعة البناء وتحسين الأداء.'],
                ],
            ],

                        [
                'skill_category_id' => 4,
                'slug' => 'visual-studio-code',
                'icon' => 'code',
                'level' => 95,
                'years_experience' => 5,
                'featured' => true,
                'order' => 6,
                'translations' => [
                    'en' => ['name' => 'Visual Studio Code', 'description' => 'Primary development environment for building modern web applications with support for debugging, extensions, Git integration, and productivity tools.'],
                    'pt' => ['name' => 'Visual Studio Code', 'description' => 'Ambiente principal de desenvolvimento para aplicações web modernas com depuração, extensões e integração com Git.'],
                    'es' => ['name' => 'Visual Studio Code', 'description' => 'Entorno principal de desarrollo para aplicaciones web modernas con depuración, extensiones e integración con Git.'],
                    'de' => ['name' => 'Visual Studio Code', 'description' => 'Hauptentwicklungsumgebung für moderne Webanwendungen mit Debugging, Erweiterungen und Git-Integration.'],
                    'tr' => ['name' => 'Visual Studio Code', 'description' => 'Hata ayıklama, eklentiler ve Git entegrasyonu ile modern web geliştirme için kullanılan temel geliştirme ortamı.'],
                    'fa' => ['name' => 'Visual Studio Code', 'description' => 'محیط اصلی توسعه برای ساخت برنامه‌های وب مدرن همراه با دیباگ، افزونه‌ها و یکپارچگی Git.'],
                    'ar' => ['name' => 'Visual Studio Code', 'description' => 'بيئة التطوير الأساسية لبناء تطبيقات الويب الحديثة مع دعم التصحيح والإضافات وتكامل Git.'],
                ],
            ],

            [
                'skill_category_id' => 4,
                'slug' => 'figma',
                'icon' => 'design_services',
                'level' => 60,
                'years_experience' => 4,
                'featured' => false,
                'order' => 7,
                'translations' => [
                    'en' => ['name' => 'Figma', 'description' => 'Using Figma to inspect designs, prototype interfaces, collaborate with designers, and transform UI designs into responsive web applications.'],
                    'pt' => ['name' => 'Figma', 'description' => 'Utilização do Figma para inspeção de layouts, prototipação e colaboração com designers.'],
                    'es' => ['name' => 'Figma', 'description' => 'Uso de Figma para inspeccionar diseños, prototipar interfaces y colaborar con diseñadores.'],
                    'de' => ['name' => 'Figma', 'description' => 'Verwendung von Figma zur Analyse von Designs, Prototyping und Zusammenarbeit mit Designern.'],
                    'tr' => ['name' => 'Figma', 'description' => 'Tasarımları incelemek, prototiplemek ve tasarımcılarla iş birliği yapmak için Figma kullanımı.'],
                    'fa' => ['name' => 'Figma', 'description' => 'استفاده از Figma برای بررسی طراحی‌ها، نمونه‌سازی و همکاری با طراحان.'],
                    'ar' => ['name' => 'Figma', 'description' => 'استخدام Figma لفحص التصاميم وإنشاء النماذج الأولية والتعاون مع المصممين.'],
                ],
            ],

            [
                'skill_category_id' => 4,
                'slug' => 'postman',
                'icon' => 'api',
                'level' => 70,
                'years_experience' => 4,
                'featured' => false,
                'order' => 8,
                'translations' => [
                    'en' => ['name' => 'Postman', 'description' => 'Testing and documenting REST APIs, validating endpoints, authentication flows, and request/response data.'],
                    'pt' => ['name' => 'Postman', 'description' => 'Teste e documentação de APIs REST, validação de endpoints e autenticação.'],
                    'es' => ['name' => 'Postman', 'description' => 'Pruebas y documentación de APIs REST, validación de endpoints y autenticación.'],
                    'de' => ['name' => 'Postman', 'description' => 'Testen und Dokumentieren von REST-APIs sowie Validierung von Endpunkten und Authentifizierung.'],
                    'tr' => ['name' => 'Postman', 'description' => 'REST API testleri, endpoint doğrulama ve kimlik doğrulama süreçleri.'],
                    'fa' => ['name' => 'Postman', 'description' => 'آزمون و مستندسازی REST APIها، اعتبارسنجی Endpointها و فرایندهای احراز هویت.'],
                    'ar' => ['name' => 'Postman', 'description' => 'اختبار وتوثيق واجهات REST API والتحقق من نقاط النهاية وعمليات المصادقة.'],
                ],
            ],

            [
                'skill_category_id' => 4,
                'slug' => 'linux',
                'icon' => 'terminal',
                'level' => 70,
                'years_experience' => 3,
                'featured' => false,
                'order' => 9,
                'translations' => [
                    'en' => ['name' => 'Linux', 'description' => 'Working with Linux environments for development, package management, file systems, command-line utilities, and server-related tasks.'],
                    'pt' => ['name' => 'Linux', 'description' => 'Utilização do Linux para desenvolvimento, gerenciamento de pacotes, sistema de arquivos e linha de comando.'],
                    'es' => ['name' => 'Linux', 'description' => 'Uso de Linux para desarrollo, administración de paquetes, sistema de archivos y línea de comandos.'],
                    'de' => ['name' => 'Linux', 'description' => 'Arbeiten mit Linux für Entwicklung, Paketverwaltung und Kommandozeile.'],
                    'tr' => ['name' => 'Linux', 'description' => 'Geliştirme, paket yönetimi ve komut satırı işlemleri için Linux kullanımı.'],
                    'fa' => ['name' => 'Linux', 'description' => 'استفاده از لینوکس برای توسعه، مدیریت بسته‌ها و کار با خط فرمان.'],
                    'ar' => ['name' => 'Linux', 'description' => 'استخدام Linux للتطوير وإدارة الحزم والعمل عبر سطر الأوامر.'],
                ],
            ],

            [
                'skill_category_id' => 4,
                'slug' => 'windows',
                'icon' => 'desktop_windows',
                'level' => 90,
                'years_experience' => 15,
                'featured' => true,
                'order' => 10,
                'translations' => [
                    'en' => ['name' => 'Windows', 'description' => 'Using Windows as a primary development platform for web applications, productivity, and software development workflows.'],
                    'pt' => ['name' => 'Windows', 'description' => 'Utilização do Windows como plataforma principal para desenvolvimento de software e aplicações web.'],
                    'es' => ['name' => 'Windows', 'description' => 'Uso de Windows como plataforma principal para el desarrollo de software y aplicaciones web.'],
                    'de' => ['name' => 'Windows', 'description' => 'Verwendung von Windows als primäre Entwicklungsplattform für Webanwendungen.'],
                    'tr' => ['name' => 'Windows', 'description' => 'Web geliştirme ve yazılım geliştirme süreçlerinde Windows kullanımı.'],
                    'fa' => ['name' => 'Windows', 'description' => 'استفاده از ویندوز به عنوان پلتفرم اصلی توسعه نرم‌افزار و برنامه‌های وب.'],
                    'ar' => ['name' => 'Windows', 'description' => 'استخدام Windows كمنصة أساسية لتطوير البرمجيات وتطبيقات الويب.'],
                ],
            ],

            // -----------------------------------------------------------------
            // Category ID: 5 — Programming Languages
            // -----------------------------------------------------------------
            [
                'skill_category_id' => 5,
                'slug' => 'javascript',
                'icon' => 'javascript',
                'level' => 90,
                'years_experience' => 5,
                'featured' => true,
                'order' => 1,
                'translations' => [
                    'en' => ['name' => 'JavaScript', 'description' => 'Developing modern web applications using ES6+, asynchronous programming, modular architecture, and browser APIs.'],
                    'pt' => ['name' => 'JavaScript', 'description' => 'Desenvolvimento de aplicações web modernas utilizando ES6+, programação assíncrona, arquitetura modular e APIs do navegador.'],
                    'es' => ['name' => 'JavaScript', 'description' => 'Desarrollo de aplicaciones web modernas utilizando ES6+, programación asíncrona, arquitectura modular y APIs del navegador.'],
                    'de' => ['name' => 'JavaScript', 'description' => 'Entwicklung moderner Webanwendungen mit ES6+, asynchroner Programmierung und modularer Architektur.'],
                    'tr' => ['name' => 'JavaScript', 'description' => 'ES6+, asenkron programlama ve modüler mimari kullanarak modern web uygulamaları geliştirme.'],
                    'fa' => ['name' => 'JavaScript', 'description' => 'توسعه برنامه‌های مدرن وب با استفاده از ES6+، برنامه‌نویسی ناهمگام و معماری ماژولار.'],
                    'ar' => ['name' => 'JavaScript', 'description' => 'تطوير تطبيقات ويب حديثة باستخدام ES6+ والبرمجة غير المتزامنة والمعمارية المعيارية.'],
                ],
            ],

            [
                'skill_category_id' => 5,
                'slug' => 'php',
                'icon' => 'code',
                'level' => 70,
                'years_experience' => 3,
                'featured' => false,
                'order' => 2,
                'translations' => [
                    'en' => ['name' => 'PHP', 'description' => 'Developing server-side applications using object-oriented PHP and modern development practices.'],
                    'pt' => ['name' => 'PHP', 'description' => 'Desenvolvimento de aplicações back-end utilizando PHP orientado a objetos.'],
                    'es' => ['name' => 'PHP', 'description' => 'Desarrollo de aplicaciones back-end utilizando PHP orientado a objetos.'],
                    'de' => ['name' => 'PHP', 'description' => 'Entwicklung serverseitiger Anwendungen mit objektorientiertem PHP.'],
                    'tr' => ['name' => 'PHP', 'description' => 'Nesne yönelimli PHP ile sunucu tarafı uygulamaları geliştirme.'],
                    'fa' => ['name' => 'PHP', 'description' => 'توسعه برنامه‌های سمت سرور با استفاده از PHP شیءگرا.'],
                    'ar' => ['name' => 'PHP', 'description' => 'تطوير تطبيقات الخادم باستخدام PHP الحديث والبرمجة كائنية التوجه.'],
                ],
            ],

            [
                'skill_category_id' => 5,
                'slug' => 'python',
                'icon' => 'code',
                'level' => 50,
                'years_experience' => 1,
                'featured' => false,
                'order' => 3,
                'translations' => [
                    'en' => ['name' => 'Python', 'description' => 'Developing scripts, automation tools, and general-purpose applications using Python while applying object-oriented programming principles and clean coding practices.'],
                    'pt' => ['name' => 'Python', 'description' => 'Desenvolvimento de scripts, automações e aplicações de propósito geral utilizando Python com foco em programação orientada a objetos e boas práticas.'],
                    'es' => ['name' => 'Python', 'description' => 'Desarrollo de scripts, automatizaciones y aplicaciones de propósito general utilizando Python y principios de programación orientada a objetos.'],
                    'de' => ['name' => 'Python', 'description' => 'Entwicklung von Skripten, Automatisierungen und allgemeinen Anwendungen mit Python unter Anwendung objektorientierter Programmierung.'],
                    'tr' => ['name' => 'Python', 'description' => 'Python kullanarak betikler, otomasyon araçları ve genel amaçlı uygulamalar geliştirme; nesne yönelimli programlama ilkelerini uygulama.'],
                    'fa' => ['name' => 'Python', 'description' => 'توسعه اسکریپت‌ها، ابزارهای خودکارسازی و برنامه‌های عمومی با استفاده از Python و اصول برنامه‌نویسی شیءگرا.'],
                    'ar' => ['name' => 'Python', 'description' => 'تطوير البرامج النصية وأدوات الأتمتة والتطبيقات العامة باستخدام Python مع تطبيق مبادئ البرمجة كائنية التوجه.'],
                ],
            ],

            // -----------------------------------------------------------------
            // Category ID: 6 — Frameworks & Libraries
            // -----------------------------------------------------------------

            [
                'skill_category_id' => 6,
                'slug' => 'vue-js',
                'icon' => 'web',
                'level' => 85,
                'years_experience' => 4,
                'featured' => true,
                'order' => 1,
                'translations' => [
                    'en' => ['name' => 'Vue.js', 'description' => 'Building scalable Single Page Applications using Vue.js and component-based architecture.'],
                    'pt' => ['name' => 'Vue.js', 'description' => 'Desenvolvimento de SPAs utilizando Vue.js e arquitetura baseada em componentes.'],
                    'es' => ['name' => 'Vue.js', 'description' => 'Desarrollo de SPAs utilizando Vue.js y arquitectura basada en componentes.'],
                    'de' => ['name' => 'Vue.js', 'description' => 'Entwicklung moderner Single-Page-Anwendungen mit Vue.js.'],
                    'tr' => ['name' => 'Vue.js', 'description' => 'Vue.js ile bileşen tabanlı SPA geliştirme.'],
                    'fa' => ['name' => 'Vue.js', 'description' => 'توسعه برنامه‌های تک‌صفحه‌ای با Vue.js.'],
                    'ar' => ['name' => 'Vue.js', 'description' => 'تطوير تطبيقات SPA باستخدام Vue.js.'],
                ],
            ],

            [
                'skill_category_id' => 6,
                'slug' => 'laravel-framework',
                'icon' => 'dns',
                'level' => 60,
                'years_experience' => 4,
                'featured' => false,
                'order' => 2,
                'translations' => [
                    'en' => ['name' => 'Laravel', 'description' => 'Building robust web applications using Laravel, Eloquent ORM, authentication, queues, migrations, and RESTful APIs.'],
                    'pt' => ['name' => 'Laravel', 'description' => 'Desenvolvimento de aplicações robustas utilizando Laravel e seu ecossistema.'],
                    'es' => ['name' => 'Laravel', 'description' => 'Desarrollo de aplicaciones robustas utilizando Laravel.'],
                    'de' => ['name' => 'Laravel', 'description' => 'Entwicklung robuster Anwendungen mit Laravel.'],
                    'tr' => ['name' => 'Laravel', 'description' => 'Laravel ile ölçeklenebilir web uygulamaları geliştirme.'],
                    'fa' => ['name' => 'Laravel', 'description' => 'توسعه برنامه‌های وب با فریم‌ورک Laravel.'],
                    'ar' => ['name' => 'Laravel', 'description' => 'تطوير تطبيقات ويب باستخدام إطار Laravel.'],
                ],
            ],

            [
                'skill_category_id' => 6,
                'slug' => 'inertia-js',
                'icon' => 'sync_alt',
                'level' => 80,
                'years_experience' => 4,
                'featured' => false,
                'order' => 3,
                'translations' => [
                    'en' => ['name' => 'Inertia.js', 'description' => 'Building modern monolithic applications by connecting Laravel and Vue.js without a traditional REST API layer.'],
                    'pt' => ['name' => 'Inertia.js', 'description' => 'Integração entre Laravel e Vue.js para aplicações modernas.'],
                    'es' => ['name' => 'Inertia.js', 'description' => 'Integración entre Laravel y Vue.js para aplicaciones modernas.'],
                    'de' => ['name' => 'Inertia.js', 'description' => 'Verbindung von Laravel und Vue.js für moderne Anwendungen.'],
                    'tr' => ['name' => 'Inertia.js', 'description' => 'Laravel ve Vue.js entegrasyonu.'],
                    'fa' => ['name' => 'Inertia.js', 'description' => 'یکپارچه‌سازی Laravel و Vue.js برای توسعه برنامه‌های مدرن.'],
                    'ar' => ['name' => 'Inertia.js', 'description' => 'ربط Laravel مع Vue.js لبناء تطبيقات حديثة.'],
                ],
            ],

            [
                'skill_category_id' => 6,
                'slug' => 'vue-i18n',
                'icon' => 'translate',
                'level' => 85,
                'years_experience' => 2,
                'featured' => true,
                'order' => 4,
                'translations' => [
                    'en' => ['name' => 'Vue I18n', 'description' => 'Implementing multilingual interfaces and localization strategies for Vue.js applications.'],
                    'pt' => ['name' => 'Vue I18n', 'description' => 'Implementação de internacionalização em aplicações Vue.js.'],
                    'es' => ['name' => 'Vue I18n', 'description' => 'Implementación de internacionalización en aplicaciones Vue.js.'],
                    'de' => ['name' => 'Vue I18n', 'description' => 'Internationalisierung von Vue.js-Anwendungen.'],
                    'tr' => ['name' => 'Vue I18n', 'description' => 'Vue.js uygulamalarında çoklu dil desteği.'],
                    'fa' => ['name' => 'Vue I18n', 'description' => 'پیاده‌سازی چندزبانه در برنامه‌های Vue.js.'],
                    'ar' => ['name' => 'Vue I18n', 'description' => 'تنفيذ دعم اللغات المتعددة في تطبيقات Vue.js.'],
                ],
            ],

            [
                'skill_category_id' => 6,
                'slug' => 'vueuse',
                'icon' => 'extension',
                'level' => 75,
                'years_experience' => 2,
                'featured' => true,
                'order' => 5,
                'translations' => [
                    'en' => ['name' => 'VueUse', 'description' => 'Leveraging composable utilities to simplify reactive programming and improve Vue.js development productivity.'],
                    'pt' => ['name' => 'VueUse', 'description' => 'Utilização de composables para aumentar a produtividade em projetos Vue.js.'],
                    'es' => ['name' => 'VueUse', 'description' => 'Uso de composables para aumentar la productividad en Vue.js.'],
                    'de' => ['name' => 'VueUse', 'description' => 'Verwendung wiederverwendbarer Composables für Vue.js.'],
                    'tr' => ['name' => 'VueUse', 'description' => 'Vue.js geliştirmeyi kolaylaştıran composable araçlar.'],
                    'fa' => ['name' => 'VueUse', 'description' => 'استفاده از مجموعه Composableها برای توسعه Vue.js.'],
                    'ar' => ['name' => 'VueUse', 'description' => 'استخدام أدوات VueUse لتحسين إنتاجية تطوير Vue.js.'],
                ],
            ],

            [
                'skill_category_id' => 6,
                'slug' => 'vue-router',
                'icon' => 'route',
                'level' => 70,
                'years_experience' => 3,
                'featured' => true,
                'order' => 6,
                'translations' => [
                    'en' => ['name' => 'Vue Router', 'description' => 'Implementing client-side routing, nested routes, navigation guards, and dynamic route management in Vue.js applications.'],
                    'pt' => ['name' => 'Vue Router', 'description' => 'Implementação de roteamento, rotas aninhadas, guards de navegação e gerenciamento dinâmico de rotas em aplicações Vue.js.'],
                    'es' => ['name' => 'Vue Router', 'description' => 'Implementación de enrutamiento, rutas anidadas, guardias de navegación y gestión dinámica de rutas en aplicaciones Vue.js.'],
                    'de' => ['name' => 'Vue Router', 'description' => 'Implementierung von Client-seitigem Routing, verschachtelten Routen und Navigationsschutz in Vue.js-Anwendungen.'],
                    'tr' => ['name' => 'Vue Router', 'description' => 'Vue.js uygulamalarında istemci tarafı yönlendirme, iç içe rotalar ve gezinme korumalarının uygulanması.'],
                    'fa' => ['name' => 'Vue Router', 'description' => 'پیاده‌سازی مسیریابی سمت کاربر، مسیرهای تو در تو و Navigation Guard در برنامه‌های Vue.js.'],
                    'ar' => ['name' => 'Vue Router', 'description' => 'تنفيذ التوجيه في جانب العميل والمسارات المتداخلة وحماية التنقل في تطبيقات Vue.js.'],
                ],
            ],

            [
                'skill_category_id' => 6,
                'slug' => 'pinia',
                'icon' => 'account_tree',
                'level' => 80,
                'years_experience' => 3,
                'featured' => true,
                'order' => 7,
                'translations' => [
                    'en' => ['name' => 'Pinia', 'description' => 'Managing application state using Pinia with modular stores, reactive patterns, and scalable architecture.'],
                    'pt' => ['name' => 'Pinia', 'description' => 'Gerenciamento de estado utilizando Pinia com stores modulares e arquitetura escalável.'],
                    'es' => ['name' => 'Pinia', 'description' => 'Gestión de estado utilizando Pinia con stores modulares y arquitectura escalable.'],
                    'de' => ['name' => 'Pinia', 'description' => 'Zustandsverwaltung mit Pinia unter Verwendung modularer Stores und skalierbarer Architektur.'],
                    'tr' => ['name' => 'Pinia', 'description' => 'Modüler store yapıları ve ölçeklenebilir mimari ile Pinia kullanarak durum yönetimi.'],
                    'fa' => ['name' => 'Pinia', 'description' => 'مدیریت وضعیت برنامه با استفاده از Pinia، Storeهای ماژولار و معماری مقیاس‌پذیر.'],
                    'ar' => ['name' => 'Pinia', 'description' => 'إدارة حالة التطبيق باستخدام Pinia مع متاجر معيارية وبنية قابلة للتوسع.'],
                ],
            ],

            [
                'skill_category_id' => 6,
                'slug' => 'axios',
                'icon' => 'sync',
                'level' => 90,
                'years_experience' => 3,
                'featured' => true,
                'order' => 8,
                'translations' => [
                    'en' => ['name' => 'Axios', 'description' => 'Integrating RESTful APIs using Axios for HTTP requests, authentication, error handling, and asynchronous data communication.'],
                    'pt' => ['name' => 'Axios', 'description' => 'Integração com APIs REST utilizando Axios para requisições HTTP, autenticação e tratamento de erros.'],
                    'es' => ['name' => 'Axios', 'description' => 'Integración con APIs REST utilizando Axios para solicitudes HTTP, autenticación y manejo de errores.'],
                    'de' => ['name' => 'Axios', 'description' => 'Integration von REST-APIs mit Axios für HTTP-Anfragen, Authentifizierung und Fehlerbehandlung.'],
                    'tr' => ['name' => 'Axios', 'description' => 'HTTP istekleri, kimlik doğrulama ve hata yönetimi için Axios ile REST API entegrasyonu.'],
                    'fa' => ['name' => 'Axios', 'description' => 'یکپارچه‌سازی REST APIها با Axios برای ارسال درخواست‌های HTTP، احراز هویت و مدیریت خطاها.'],
                    'ar' => ['name' => 'Axios', 'description' => 'دمج واجهات REST API باستخدام Axios لطلبات HTTP والمصادقة ومعالجة الأخطاء.'],
                ],
            ],

            [
                'skill_category_id' => 6,
                'slug' => 'primevue',
                'icon' => 'widgets',
                'level' => 95,
                'years_experience' => 4,
                'featured' => true,
                'order' => 9,
                'translations' => [
                    'en' => ['name' => 'PrimeVue', 'description' => 'Building professional user interfaces using PrimeVue components, theming, Pass Through (PT), dialogs, forms, data tables, and advanced UI customization.'],
                    'pt' => ['name' => 'PrimeVue', 'description' => 'Desenvolvimento de interfaces profissionais utilizando componentes PrimeVue, temas, Pass Through (PT), diálogos, formulários, tabelas e personalizações avançadas.'],
                    'es' => ['name' => 'PrimeVue', 'description' => 'Desarrollo de interfaces profesionales utilizando componentes PrimeVue, temas, Pass Through (PT), diálogos, formularios, tablas y personalizaciones avanzadas.'],
                    'de' => ['name' => 'PrimeVue', 'description' => 'Entwicklung professioneller Benutzeroberflächen mit PrimeVue-Komponenten, Themes, Pass Through (PT), Dialogen, Formularen und Tabellen.'],
                    'tr' => ['name' => 'PrimeVue', 'description' => 'PrimeVue bileşenleri, temalar, Pass Through (PT), diyaloglar, formlar ve gelişmiş özelleştirmeler ile profesyonel kullanıcı arayüzleri geliştirme.'],
                    'fa' => ['name' => 'PrimeVue', 'description' => 'توسعه رابط‌های کاربری حرفه‌ای با استفاده از کامپوننت‌های PrimeVue، قالب‌ها، Pass Through (PT)، دیالوگ‌ها، فرم‌ها و سفارشی‌سازی پیشرفته.'],
                    'ar' => ['name' => 'PrimeVue', 'description' => 'تطوير واجهات مستخدم احترافية باستخدام مكونات PrimeVue والقوالب وPass Through (PT) والنوافذ المنبثقة والنماذج والجداول والتخصيصات المتقدمة.'],
                ],
            ],

            // -----------------------------------------------------------------
            // Category ID: 7 — Software Architecture
            // -----------------------------------------------------------------

            [
                'skill_category_id' => 7,
                'slug' => 'component-based-architecture',
                'icon' => 'account_tree',
                'level' => 85,
                'years_experience' => 4,
                'featured' => true,
                'order' => 1,
                'translations' => [
                    'en' => ['name' => 'Component-Based Architecture', 'description' => 'Designing reusable, modular, and maintainable user interfaces using component-driven architecture to improve scalability and code organization.'],
                    'pt' => ['name' => 'Arquitetura Baseada em Componentes', 'description' => 'Desenvolvimento de interfaces reutilizáveis e modulares utilizando arquitetura baseada em componentes para melhorar a escalabilidade e a organização do código.'],
                    'es' => ['name' => 'Arquitectura Basada en Componentes', 'description' => 'Desarrollo de interfaces reutilizables y modulares utilizando una arquitectura basada en componentes para mejorar la escalabilidad y la organización del código.'],
                    'de' => ['name' => 'Komponentenbasierte Architektur', 'description' => 'Entwicklung wiederverwendbarer und modularer Benutzeroberflächen mit komponentenbasierter Architektur.'],
                    'tr' => ['name' => 'Bileşen Tabanlı Mimari', 'description' => 'Yeniden kullanılabilir ve modüler kullanıcı arayüzleri geliştirmek için bileşen tabanlı mimari kullanımı.'],
                    'fa' => ['name' => 'معماری مبتنی بر کامپوننت', 'description' => 'طراحی رابط‌های کاربری ماژولار و قابل استفاده مجدد با استفاده از معماری مبتنی بر کامپوننت.'],
                    'ar' => ['name' => 'الهيكلية المعتمدة على المكونات', 'description' => 'تصميم واجهات مستخدم معيارية وقابلة لإعادة الاستخدام باستخدام الهيكلية المعتمدة على المكونات.'],
                ],
            ],

            [
                'skill_category_id' => 7,
                'slug' => 'mvc-architecture',
                'icon' => 'schema',
                'level' => 75,
                'years_experience' => 3,
                'featured' => false,
                'order' => 2,
                'translations' => [
                    'en' => ['name' => 'MVC Architecture', 'description' => 'Developing maintainable applications using the Model-View-Controller pattern to separate concerns and improve scalability and code organization.'],
                    'pt' => ['name' => 'Arquitetura MVC', 'description' => 'Desenvolvimento de aplicações utilizando o padrão Model-View-Controller para melhorar a organização e a manutenção do código.'],
                    'es' => ['name' => 'Arquitectura MVC', 'description' => 'Desarrollo de aplicaciones utilizando el patrón Modelo-Vista-Controlador para mejorar la organización y el mantenimiento del código.'],
                    'de' => ['name' => 'MVC-Architektur', 'description' => 'Entwicklung wartbarer Anwendungen mit dem Model-View-Controller-Muster zur Trennung von Verantwortlichkeiten.'],
                    'tr' => ['name' => 'MVC Mimarisi', 'description' => 'Kodun sürdürülebilirliğini ve ölçeklenebilirliğini artırmak için Model-Görünüm-Denetleyici mimarisi kullanımı.'],
                    'fa' => ['name' => 'معماری MVC', 'description' => 'توسعه برنامه‌های قابل نگهداری با استفاده از الگوی Model-View-Controller برای جداسازی مسئولیت‌ها.'],
                    'ar' => ['name' => 'معمارية MVC', 'description' => 'تطوير تطبيقات قابلة للصيانة باستخدام نمط Model-View-Controller لتحسين تنظيم الكود وقابليته للتوسع.'],
                ],
            ],            

            // -----------------------------------------------------------------
            // Category ID: 8 — Testing & Quality
            // -----------------------------------------------------------------
            
            [
                'skill_category_id' => 8,
                'slug' => 'debugging',
                'icon' => 'bug_report',
                'level' => 80,
                'years_experience' => 4,
                'featured' => false,
                'order' => 1,
                'translations' => [
                    'en' => ['name' => 'Debugging', 'description' => 'Identifying, analyzing, and resolving front-end and back-end issues through systematic debugging, browser developer tools, and application logs.'],
                    'pt' => ['name' => 'Depuração', 'description' => 'Identificação, análise e resolução de problemas de front-end e back-end utilizando ferramentas de desenvolvimento e logs da aplicação.'],
                    'es' => ['name' => 'Depuración', 'description' => 'Identificación, análisis y resolución de problemas de front-end y back-end mediante herramientas de desarrollo y registros de la aplicación.'],
                    'de' => ['name' => 'Fehlerbehebung', 'description' => 'Identifizieren, Analysieren und Beheben von Frontend- und Backend-Fehlern mithilfe von Entwicklertools und Anwendungsprotokollen.'],
                    'tr' => ['name' => 'Hata Ayıklama', 'description' => 'Geliştirici araçları ve uygulama günlüklerini kullanarak ön uç ve arka uç sorunlarını analiz etme ve çözme.'],
                    'fa' => ['name' => 'اشکال‌زدایی', 'description' => 'شناسایی، تحلیل و رفع مشکلات فرانت‌اند و بک‌اند با استفاده از ابزارهای توسعه و لاگ‌های برنامه.'],
                    'ar' => ['name' => 'تصحيح الأخطاء', 'description' => 'تحديد وتحليل وحل مشكلات الواجهة الأمامية والخلفية باستخدام أدوات المطور وسجلات التطبيق.'],
                ],
            ],

            [
                'skill_category_id' => 8,
                'slug' => 'code-refactoring',
                'icon' => 'auto_fix_high',
                'level' => 70,
                'years_experience' => 3,
                'featured' => false,
                'order' => 2,
                'translations' => [
                    'en' => ['name' => 'Code Refactoring', 'description' => 'Improving code readability, maintainability, and performance while preserving existing functionality through structured refactoring techniques.'],
                    'pt' => ['name' => 'Refatoração de Código', 'description' => 'Melhoria da legibilidade, manutenção e desempenho do código preservando seu comportamento existente.'],
                    'es' => ['name' => 'Refactorización de Código', 'description' => 'Mejora de la legibilidad, mantenibilidad y rendimiento del código sin alterar su funcionalidad.'],
                    'de' => ['name' => 'Code-Refactoring', 'description' => 'Verbesserung der Lesbarkeit, Wartbarkeit und Leistung des Codes ohne Änderung seines Verhaltens.'],
                    'tr' => ['name' => 'Kod Yeniden Düzenleme', 'description' => 'Kodun okunabilirliğini, sürdürülebilirliğini ve performansını işlevselliği koruyarak iyileştirme.'],
                    'fa' => ['name' => 'بازآرایی کد', 'description' => 'بهبود خوانایی، نگهداری و عملکرد کد بدون تغییر در رفتار آن.'],
                    'ar' => ['name' => 'إعادة هيكلة الكود', 'description' => 'تحسين قابلية قراءة الكود وصيانته وأدائه مع الحفاظ على الوظائف الحالية.'],
                ],
            ],

            [
                'skill_category_id' => 8,
                'slug' => 'vitest',
                'icon' => 'science',
                'level' => 20,
                'years_experience' => 1,
                'featured' => false,
                'order' => 3,
                'translations' => [
                    'en' => ['name' => 'Vitest', 'description' => 'Writing and maintaining unit and component tests for Vue.js applications using Vitest, with a focus on reliable, maintainable, and automated testing workflows.'],
                    'pt' => ['name' => 'Vitest', 'description' => 'Desenvolvimento e manutenção de testes unitários e de componentes para aplicações Vue.js utilizando Vitest, com foco em testes automatizados e confiáveis.'],
                    'es' => ['name' => 'Vitest', 'description' => 'Desarrollo y mantenimiento de pruebas unitarias y de componentes para aplicaciones Vue.js utilizando Vitest, con enfoque en pruebas automatizadas y confiables.'],
                    'de' => ['name' => 'Vitest', 'description' => 'Entwicklung und Wartung von Unit- und Komponententests für Vue.js-Anwendungen mit Vitest und Fokus auf zuverlässige automatisierte Tests.'],
                    'tr' => ['name' => 'Vitest', 'description' => 'Vue.js uygulamaları için Vitest kullanarak birim ve bileşen testleri geliştirme ve bakımını yapma.'],
                    'fa' => ['name' => 'Vitest', 'description' => 'توسعه و نگهداری تست‌های واحد و کامپوننت برای برنامه‌های Vue.js با استفاده از Vitest و تمرکز بر تست‌های خودکار و قابل اعتماد.'],
                    'ar' => ['name' => 'Vitest', 'description' => 'كتابة وصيانة اختبارات الوحدات والمكونات لتطبيقات Vue.js باستخدام Vitest مع التركيز على الاختبارات الآلية والموثوقة.'],
                ],
            ],

            // -----------------------------------------------------------------
            // Category ID: 9 — Languages
            // -----------------------------------------------------------------

            [
                'skill_category_id' => 9,
                'slug' => 'persian',
                'icon' => 'language',
                'level' => 100,
                'years_experience' => 27,
                'featured' => false,
                'order' => 1,
                'translations' => [
                    'en' => ['name' => 'Persian (Farsi)', 'description' => 'Native speaker with complete proficiency in speaking, reading, writing, and professional communication.'],
                    'pt' => ['name' => 'Persa (Farsi)', 'description' => 'Falante nativo com proficiência completa em conversação, leitura, escrita e comunicação profissional.'],
                    'es' => ['name' => 'Persa (Farsi)', 'description' => 'Hablante nativo con dominio completo de conversación, lectura, escritura y comunicación profesional.'],
                    'de' => ['name' => 'Persisch (Farsi)', 'description' => 'Muttersprachler mit vollständiger Beherrschung in Sprechen, Lesen, Schreiben und beruflicher Kommunikation.'],
                    'tr' => ['name' => 'Farsça', 'description' => 'Konuşma, okuma, yazma ve profesyonel iletişimde tam yetkinliğe sahip ana dil.'],
                    'fa' => ['name' => 'فارسی', 'description' => 'زبان مادری با تسلط کامل در گفتار، خواندن، نوشتن و ارتباطات حرفه‌ای.'],
                    'ar' => ['name' => 'الفارسية', 'description' => 'اللغة الأم مع إتقان كامل للمحادثة والقراءة والكتابة والتواصل المهني.'],
                ],
            ],

            [
                'skill_category_id' => 9,
                'slug' => 'english',
                'icon' => 'language',
                'level' => 85,
                'years_experience' => 9,
                'featured' => true,
                'order' => 2,
                'translations' => [
                    'en' => ['name' => 'English', 'description' => 'Professional working proficiency with experience in software development, technical documentation, and international collaboration.'],
                    'pt' => ['name' => 'Inglês', 'description' => 'Proficiência profissional utilizada em desenvolvimento de software, documentação técnica e colaboração internacional.'],
                    'es' => ['name' => 'Inglés', 'description' => 'Competencia profesional utilizada en desarrollo de software, documentación técnica y colaboración internacional.'],
                    'de' => ['name' => 'Englisch', 'description' => 'Berufliche Sprachkenntnisse für Softwareentwicklung, technische Dokumentation und internationale Zusammenarbeit.'],
                    'tr' => ['name' => 'İngilizce', 'description' => 'Yazılım geliştirme, teknik dokümantasyon ve uluslararası ekip çalışmaları için profesyonel düzeyde kullanım.'],
                    'fa' => ['name' => 'انگلیسی', 'description' => 'تسلط حرفه‌ای برای توسعه نرم‌افزار، مستندات فنی و همکاری بین‌المللی.'],
                    'ar' => ['name' => 'الإنجليزية', 'description' => 'إجادة مهنية تُستخدم في تطوير البرمجيات والوثائق التقنية والتعاون الدولي.'],
                ],
            ],

            [
                'skill_category_id' => 9,
                'slug' => 'portuguese',
                'icon' => 'language',
                'level' => 70,
                'years_experience' => 5,
                'featured' => false,
                'order' => 3,
                'translations' => [
                    'en' => ['name' => 'Portuguese', 'description' => 'Professional working proficiency developed through higher education, software development, and daily communication in Brazil.'],
                    'pt' => ['name' => 'Português', 'description' => 'Proficiência profissional desenvolvida por meio do ensino superior, desenvolvimento de software e comunicação diária no Brasil.'],
                    'es' => ['name' => 'Portugués', 'description' => 'Competencia profesional desarrollada mediante estudios superiores, desarrollo de software y comunicación diaria en Brasil.'],
                    'de' => ['name' => 'Portugiesisch', 'description' => 'Berufliche Sprachkenntnisse, entwickelt durch Studium, Softwareentwicklung und tägliche Kommunikation in Brasilien.'],
                    'tr' => ['name' => 'Portekizce', 'description' => 'Brezilya’da eğitim, yazılım geliştirme ve günlük yaşam sayesinde kazanılmış profesyonel düzey.'],
                    'fa' => ['name' => 'پرتغالی', 'description' => 'تسلط حرفه‌ای که از طریق تحصیل، توسعه نرم‌افزار و زندگی روزمره در برزیل به دست آمده است.'],
                    'ar' => ['name' => 'البرتغالية', 'description' => 'إجادة مهنية اكتُسبت من خلال الدراسة الجامعية وتطوير البرمجيات والحياة اليومية في البرازيل.'],
                ],
            ],

            [
                'skill_category_id' => 9,
                'slug' => 'turkish',
                'icon' => 'language',
                'level' => 85,
                'years_experience' => 6,
                'featured' => true,
                'order' => 4,
                'translations' => [
                    'en' => ['name' => 'Turkish', 'description' => 'Professional working proficiency acquired through university studies, professional experience, and daily life in Türkiye.'],
                    'pt' => ['name' => 'Turco', 'description' => 'Proficiência profissional adquirida durante estudos universitários, experiência profissional e vida diária na Turquia.'],
                    'es' => ['name' => 'Turco', 'description' => 'Competencia profesional adquirida durante estudios universitarios, experiencia profesional y vida cotidiana en Turquía.'],
                    'de' => ['name' => 'Türkisch', 'description' => 'Berufliche Sprachkenntnisse, erworben durch Studium, Berufserfahrung und Alltag in der Türkei.'],
                    'tr' => ['name' => 'Türkçe', 'description' => 'Üniversite eğitimi, profesyonel deneyim ve günlük yaşam sayesinde kazanılmış profesyonel düzey.'],
                    'fa' => ['name' => 'ترکی', 'description' => 'تسلط حرفه‌ای که از طریق تحصیل، تجربه کاری و زندگی روزمره در ترکیه به دست آمده است.'],
                    'ar' => ['name' => 'التركية', 'description' => 'إجادة مهنية اكتُسبت من خلال الدراسة الجامعية والخبرة العملية والحياة اليومية في تركيا.'],
                ],
            ],

            [
                'skill_category_id' => 9,
                'slug' => 'german',
                'icon' => 'language',
                'level' => 30,
                'years_experience' => 1,
                'featured' => false,
                'order' => 5,
                'translations' => [
                    'en' => ['name' => 'German', 'description' => 'Basic reading and comprehension skills developed through formal studies based on the Goethe curriculum, with a focus on understanding written and introductory spoken German.'],
                    'pt' => ['name' => 'Alemão', 'description' => 'Conhecimentos básicos de leitura e compreensão desenvolvidos por meio de estudos formais baseados no currículo Goethe, com foco na compreensão do idioma.'],
                    'es' => ['name' => 'Alemán', 'description' => 'Conocimientos básicos de lectura y comprensión desarrollados mediante estudios formales basados en el programa Goethe, con énfasis en la comprensión del idioma.'],
                    'de' => ['name' => 'Deutsch', 'description' => 'Grundkenntnisse im Lesen und Verstehen, erworben durch formales Sprachstudium nach dem Goethe-Lehrplan.'],
                    'tr' => ['name' => 'Almanca', 'description' => 'Goethe müfredatına dayalı resmi eğitimle kazanılmış temel okuma ve anlama becerileri.'],
                    'fa' => ['name' => 'آلمانی', 'description' => 'آشنایی مقدماتی با خواندن و درک زبان آلمانی که از طریق آموزش رسمی بر اساس برنامه گوته به دست آمده است.'],
                    'ar' => ['name' => 'الألمانية', 'description' => 'معرفة أساسية بالقراءة والفهم اكتُسبت من خلال دراسة رسمية وفق منهج غوته، مع التركيز على فهم اللغة.'],
                ],
            ],

            [
                'skill_category_id' => 9,
                'slug' => 'spanish',
                'icon' => 'language',
                'level' => 5,
                'years_experience' => 0,
                'featured' => false,
                'order' => 6,
                'translations' => [
                    'en' => ['name' => 'Spanish', 'description' => 'Upcoming language planned for future study to support international communication and professional development.'],
                    'pt' => ['name' => 'Espanhol', 'description' => 'Idioma planejado para estudos futuros com o objetivo de ampliar a comunicação internacional e o desenvolvimento profissional.'],
                    'es' => ['name' => 'Español', 'description' => 'Idioma planificado para estudios futuros con el objetivo de ampliar la comunicación internacional y el desarrollo profesional.'],
                    'de' => ['name' => 'Spanisch', 'description' => 'Geplante Sprache für zukünftiges Lernen zur Unterstützung der internationalen Kommunikation und beruflichen Entwicklung.'],
                    'tr' => ['name' => 'İspanyolca', 'description' => 'Uluslararası iletişim ve mesleki gelişimi desteklemek amacıyla gelecekte öğrenilmesi planlanan dil.'],
                    'fa' => ['name' => 'اسپانیایی', 'description' => 'زبانی که برای یادگیری در آینده به منظور گسترش ارتباطات بین‌المللی و توسعه حرفه‌ای برنامه‌ریزی شده است.'],
                    'ar' => ['name' => 'الإسبانية', 'description' => 'لغة مخطط لدراستها مستقبلاً لدعم التواصل الدولي والتطور المهني.'],
                ],
            ],

            [
                'skill_category_id' => 9,
                'slug' => 'arabic',
                'icon' => 'language',
                'level' => 5,
                'years_experience' => 0,
                'featured' => false,
                'order' => 7,
                'translations' => [
                    'en' => ['name' => 'Arabic', 'description' => 'Upcoming language planned for future study to expand multilingual communication skills.'],
                    'pt' => ['name' => 'Árabe', 'description' => 'Idioma planejado para estudos futuros com o objetivo de ampliar as habilidades de comunicação multilíngue.'],
                    'es' => ['name' => 'Árabe', 'description' => 'Idioma planificado para estudios futuros con el objetivo de ampliar las habilidades de comunicación multilingüe.'],
                    'de' => ['name' => 'Arabisch', 'description' => 'Geplante Sprache für zukünftiges Lernen zur Erweiterung der mehrsprachigen Kommunikationsfähigkeiten.'],
                    'tr' => ['name' => 'Arapça', 'description' => 'Çok dilli iletişim becerilerini geliştirmek amacıyla gelecekte öğrenilmesi planlanan dil.'],
                    'fa' => ['name' => 'عربی', 'description' => 'زبانی که برای یادگیری در آینده به منظور گسترش مهارت‌های ارتباطی چندزبانه برنامه‌ریزی شده است.'],
                    'ar' => ['name' => 'العربية', 'description' => 'لغة مخطط لدراستها مستقبلاً لتطوير مهارات التواصل متعدد اللغات.'],
                ],
            ],
        ];

        foreach ($skills as $skillData) {

            $translations = $skillData['translations'];

            unset($skillData['translations']);

            $skill = Skill::updateOrCreate(
                ['slug' => $skillData['slug']],
                $skillData
            );

            foreach ($translations as $locale => $translation) {

                $language = Language::where('code', $locale)->first();

                if (! $language) {
                    continue;
                }

                $skill->translations()->updateOrCreate(
                    [
                        'language_id' => $language->id,
                    ],
                    $translation
                );
            }
        }
    }
}

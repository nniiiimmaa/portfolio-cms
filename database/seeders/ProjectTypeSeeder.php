<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProjectType;

class ProjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'slug' => 'website',
                'color' => '#3B82F6',
                'translations' => [
                    'en' => 'Website',
                    'pt' => 'Site',
                    'es' => 'Sitio Web',
                    'de' => 'Webseite',
                    'tr' => 'Web Sitesi',
                    'fa' => 'وب‌سایت',
                    'ar' => 'موقع إلكتروني',
                ],
            ],

            [
                'slug' => 'landing-page',
                'color' => '#10B981',
                'translations' => [
                    'en' => 'Landing Page',
                    'pt' => 'Landing Page',
                    'es' => 'Landing Page',
                    'de' => 'Landingpage',
                    'tr' => 'Açılış Sayfası',
                    'fa' => 'صفحه فرود',
                    'ar' => 'صفحة هبوط',
                ],
            ],

            [
                'slug' => 'portfolio',
                'color' => '#F97316',
                'translations' => [
                    'en' => 'Portfolio',
                    'pt' => 'Portfólio',
                    'es' => 'Portafolio',
                    'de' => 'Portfolio',
                    'tr' => 'Portföy',
                    'fa' => 'نمونه کار',
                    'ar' => 'معرض الأعمال',
                ],
            ],

            [
                'slug' => 'cms',
                'color' => '#0EA5E9',
                'translations' => [
                    'en' => 'Content Management System',
                    'pt' => 'Sistema de Gerenciamento de Conteúdo',
                    'es' => 'Sistema de Gestión de Contenidos',
                    'de' => 'Content-Management-System',
                    'tr' => 'İçerik Yönetim Sistemi',
                    'fa' => 'سیستم مدیریت محتوا',
                    'ar' => 'نظام إدارة المحتوى',
                ],
            ],

            [
                'slug' => 'dashboard',
                'color' => '#14B8A6',
                'translations' => [
                    'en' => 'Dashboard / Admin Panel',
                    'pt' => 'Dashboard / Painel Administrativo',
                    'es' => 'Panel de Control / Administración',
                    'de' => 'Dashboard / Administrationsbereich',
                    'tr' => 'Dashboard / Yönetim Paneli',
                    'fa' => 'داشبورد / پنل مدیریت',
                    'ar' => 'لوحة التحكم / لوحة الإدارة',
                ],
            ],

            [
                'slug' => 'ecommerce',
                'color' => '#EC4899',
                'translations' => [
                    'en' => 'E-commerce Platform',
                    'pt' => 'Plataforma de E-commerce',
                    'es' => 'Plataforma de Comercio Electrónico',
                    'de' => 'E-Commerce-Plattform',
                    'tr' => 'E-Ticaret Platformu',
                    'fa' => 'پلتفرم فروشگاه اینترنتی',
                    'ar' => 'منصة تجارة إلكترونية',
                ],
            ],

            [
                'slug' => 'lms',
                'color' => '#8B5CF6',
                'translations' => [
                    'en' => 'Learning Management System',
                    'pt' => 'Sistema de Gestão de Aprendizagem',
                    'es' => 'Sistema de Gestión del Aprendizaje',
                    'de' => 'Lernmanagementsystem',
                    'tr' => 'Öğrenme Yönetim Sistemi',
                    'fa' => 'سیستم مدیریت یادگیری',
                    'ar' => 'نظام إدارة التعلم',
                ],
            ],

            [
                'slug' => 'project-management',
                'color' => '#6366F1',
                'translations' => [
                    'en' => 'Project Management System',
                    'pt' => 'Sistema de Gerenciamento de Projetos',
                    'es' => 'Sistema de Gestión de Proyectos',
                    'de' => 'Projektmanagementsystem',
                    'tr' => 'Proje Yönetim Sistemi',
                    'fa' => 'سیستم مدیریت پروژه',
                    'ar' => 'نظام إدارة المشاريع',
                ],
            ],

            [
                'slug' => 'crm',
                'color' => '#F59E0B',
                'translations' => [
                    'en' => 'Customer Relationship Management',
                    'pt' => 'Gestão de Relacionamento com Clientes',
                    'es' => 'Gestión de Relaciones con Clientes',
                    'de' => 'Customer-Relationship-Management',
                    'tr' => 'Müşteri İlişkileri Yönetimi',
                    'fa' => 'مدیریت ارتباط با مشتری',
                    'ar' => 'إدارة علاقات العملاء',
                ],
            ],

            [
                'slug' => 'erp',
                'color' => '#EF4444',
                'translations' => [
                    'en' => 'Enterprise Resource Planning',
                    'pt' => 'Planejamento de Recursos Empresariais',
                    'es' => 'Planificación de Recursos Empresariales',
                    'de' => 'Enterprise Resource Planning',
                    'tr' => 'Kurumsal Kaynak Planlama',
                    'fa' => 'برنامه‌ریزی منابع سازمانی',
                    'ar' => 'تخطيط موارد المؤسسة',
                ],
            ],

            [
                'slug' => 'booking',
                'color' => '#84CC16',
                'translations' => [
                    'en' => 'Booking & Reservation System',
                    'pt' => 'Sistema de Reservas',
                    'es' => 'Sistema de Reservas',
                    'de' => 'Buchungs- und Reservierungssystem',
                    'tr' => 'Rezervasyon Sistemi',
                    'fa' => 'سیستم رزرو',
                    'ar' => 'نظام الحجز',
                ],
            ],

            [
                'slug' => 'inventory',
                'color' => '#06B6D4',
                'translations' => [
                    'en' => 'Inventory Management System',
                    'pt' => 'Sistema de Gestão de Estoque',
                    'es' => 'Sistema de Gestión de Inventario',
                    'de' => 'Lagerverwaltungssystem',
                    'tr' => 'Stok Yönetim Sistemi',
                    'fa' => 'سیستم مدیریت انبار',
                    'ar' => 'نظام إدارة المخزون',
                ],
            ],

            [
                'slug' => 'pos',
                'color' => '#F43F5E',
                'translations' => [
                    'en' => 'Point of Sale',
                    'pt' => 'Ponto de Venda',
                    'es' => 'Punto de Venta',
                    'de' => 'Kassensystem',
                    'tr' => 'Satış Noktası',
                    'fa' => 'سیستم فروش',
                    'ar' => 'نقطة البيع',
                ],
            ],

            [
                'slug' => 'hrm',
                'color' => '#A855F7',
                'translations' => [
                    'en' => 'Human Resources Management',
                    'pt' => 'Gestão de Recursos Humanos',
                    'es' => 'Gestión de Recursos Humanos',
                    'de' => 'Personalmanagement',
                    'tr' => 'İnsan Kaynakları Yönetimi',
                    'fa' => 'مدیریت منابع انسانی',
                    'ar' => 'إدارة الموارد البشرية',
                ],
            ],

            [
                'slug' => 'helpdesk',
                'color' => '#64748B',
                'translations' => [
                    'en' => 'Help Desk / Ticketing System',
                    'pt' => 'Sistema de Chamados',
                    'es' => 'Sistema de Tickets',
                    'de' => 'Helpdesk- / Ticketsystem',
                    'tr' => 'Destek Talep Sistemi',
                    'fa' => 'سیستم تیکت',
                    'ar' => 'نظام التذاكر',
                ],
            ],

            [
                'slug' => 'social-network',
                'color' => '#2563EB',
                'translations' => [
                    'en' => 'Social Network',
                    'pt' => 'Rede Social',
                    'es' => 'Red Social',
                    'de' => 'Soziales Netzwerk',
                    'tr' => 'Sosyal Ağ',
                    'fa' => 'شبکه اجتماعی',
                    'ar' => 'شبكة اجتماعية',
                ],
            ],

            [
                'slug' => 'chat',
                'color' => '#22C55E',
                'translations' => [
                    'en' => 'Chat / Messaging Platform',
                    'pt' => 'Plataforma de Chat',
                    'es' => 'Plataforma de Chat',
                    'de' => 'Chat- / Messaging-Plattform',
                    'tr' => 'Mesajlaşma Platformu',
                    'fa' => 'پلتفرم پیام‌رسان',
                    'ar' => 'منصة محادثة',
                ],
            ],

            [
                'slug' => 'blog',
                'color' => '#0F766E',
                'translations' => [
                    'en' => 'Blog Platform',
                    'pt' => 'Plataforma de Blog',
                    'es' => 'Plataforma de Blog',
                    'de' => 'Blog-Plattform',
                    'tr' => 'Blog Platformu',
                    'fa' => 'پلتفرم وبلاگ',
                    'ar' => 'منصة مدونات',
                ],
            ],

            [
                'slug' => 'forum',
                'color' => '#4F46E5',
                'translations' => [
                    'en' => 'Forum',
                    'pt' => 'Fórum',
                    'es' => 'Foro',
                    'de' => 'Forum',
                    'tr' => 'Forum',
                    'fa' => 'انجمن',
                    'ar' => 'منتدى',
                ],
            ],

            [
                'slug' => 'api',
                'color' => '#DC2626',
                'translations' => [
                    'en' => 'API / Backend',
                    'pt' => 'API / Backend',
                    'es' => 'API / Backend',
                    'de' => 'API / Backend',
                    'tr' => 'API / Backend',
                    'fa' => 'API / بک‌اند',
                    'ar' => 'واجهة برمجة التطبيقات / Backend',
                ],
            ],

            [
                'slug' => 'library',
                'color' => '#16A34A',
                'translations' => [
                    'en' => 'Library / Package',
                    'pt' => 'Biblioteca / Pacote',
                    'es' => 'Biblioteca / Paquete',
                    'de' => 'Bibliothek / Paket',
                    'tr' => 'Kütüphane / Paket',
                    'fa' => 'کتابخانه / پکیج',
                    'ar' => 'مكتبة / حزمة',
                ],
            ],

            [
                'slug' => 'ui-system',
                'color' => '#7C3AED',
                'translations' => [
                    'en' => 'UI Component / Design System',
                    'pt' => 'Componente UI / Design System',
                    'es' => 'Componente UI / Sistema de Diseño',
                    'de' => 'UI-Komponente / Designsystem',
                    'tr' => 'UI Bileşeni / Tasarım Sistemi',
                    'fa' => 'کامپوننت رابط کاربری / سیستم طراحی',
                    'ar' => 'مكونات واجهة المستخدم / نظام التصميم',
                ],
            ],

            [
                'slug' => 'browser-extension',
                'color' => '#9333EA',
                'translations' => [
                    'en' => 'Browser Extension',
                    'pt' => 'Extensão de Navegador',
                    'es' => 'Extensión del Navegador',
                    'de' => 'Browser-Erweiterung',
                    'tr' => 'Tarayıcı Eklentisi',
                    'fa' => 'افزونه مرورگر',
                    'ar' => 'إضافة متصفح',
                ],
            ],

            [
                'slug' => 'mobile-app',
                'color' => '#DB2777',
                'translations' => [
                    'en' => 'Mobile Application',
                    'pt' => 'Aplicativo Mobile',
                    'es' => 'Aplicación Móvil',
                    'de' => 'Mobile Anwendung',
                    'tr' => 'Mobil Uygulama',
                    'fa' => 'اپلیکیشن موبایل',
                    'ar' => 'تطبيق جوال',
                ],
            ],

            [
                'slug' => 'desktop-app',
                'color' => '#EA580C',
                'translations' => [
                    'en' => 'Desktop Application',
                    'pt' => 'Aplicativo Desktop',
                    'es' => 'Aplicación de Escritorio',
                    'de' => 'Desktop-Anwendung',
                    'tr' => 'Masaüstü Uygulaması',
                    'fa' => 'اپلیکیشن دسکتاپ',
                    'ar' => 'تطبيق سطح المكتب',
                ],
            ],
        ];

        foreach ($types as $type) {
            $translations = $type['translations'];

            unset($type['translations']);

            $projectType = ProjectType::updateOrCreate(
                [
                    'slug' => $type['slug'],
                ],
                $type
            );

            foreach ($translations as $locale => $name) {
                $language = Language::where('code', $locale)->first();

                if (! $language) {
                    continue;
                }

                $projectType->translations()->updateOrCreate(
                    [
                        'language_id' => $language->id,
                    ],
                    [
                        'name' => $name,
                    ]
                );
            }
        }      
    }
}

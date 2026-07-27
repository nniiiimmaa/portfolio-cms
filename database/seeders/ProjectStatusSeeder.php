<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\ProjectStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'slug' => 'planning',
                'color' => '#F59E0B',
                'translations' => [
                    'en' => 'Planning',
                    'pt' => 'Planejamento',
                    'es' => 'Planificación',
                    'de' => 'Planung',
                    'tr' => 'Planlama',
                    'fa' => 'در حال برنامه‌ریزی',
                    'ar' => 'قيد التخطيط',
                ],
            ],

            [
                'slug' => 'in-progress',
                'color' => '#3B82F6',
                'translations' => [
                    'en' => 'In Progress',
                    'pt' => 'Em Desenvolvimento',
                    'es' => 'En Desarrollo',
                    'de' => 'In Entwicklung',
                    'tr' => 'Geliştiriliyor',
                    'fa' => 'در حال توسعه',
                    'ar' => 'قيد التطوير',
                ],
            ],

            [
                'slug' => 'on-hold',
                'color' => '#8B5CF6',
                'translations' => [
                    'en' => 'On Hold',
                    'pt' => 'Em Pausa',
                    'es' => 'En Pausa',
                    'de' => 'Pausiert',
                    'tr' => 'Beklemede',
                    'fa' => 'متوقف شده',
                    'ar' => 'معلق',
                ],
            ],

            [
                'slug' => 'completed',
                'color' => '#10B981',
                'translations' => [
                    'en' => 'Completed',
                    'pt' => 'Concluído',
                    'es' => 'Completado',
                    'de' => 'Abgeschlossen',
                    'tr' => 'Tamamlandı',
                    'fa' => 'تکمیل شده',
                    'ar' => 'مكتمل',
                ],
            ],

            [
                'slug' => 'maintained',
                'color' => '#06B6D4',
                'translations' => [
                    'en' => 'Maintained',
                    'pt' => 'Em Manutenção',
                    'es' => 'Mantenido',
                    'de' => 'Wird gepflegt',
                    'tr' => 'Bakımı Yapılıyor',
                    'fa' => 'در حال نگهداری',
                    'ar' => 'قيد الصيانة',
                ],
            ],

            [
                'slug' => 'archived',
                'color' => '#64748B',
                'translations' => [
                    'en' => 'Archived',
                    'pt' => 'Arquivado',
                    'es' => 'Archivado',
                    'de' => 'Archiviert',
                    'tr' => 'Arşivlendi',
                    'fa' => 'بایگانی شده',
                    'ar' => 'مؤرشف',
                ],
            ],

            [
                'slug' => 'cancelled',
                'color' => '#EF4444',
                'translations' => [
                    'en' => 'Cancelled',
                    'pt' => 'Cancelado',
                    'es' => 'Cancelado',
                    'de' => 'Abgebrochen',
                    'tr' => 'İptal Edildi',
                    'fa' => 'لغو شده',
                    'ar' => 'ملغى',
                ],
            ],
        ];

        foreach ($statuses as $status) {
            $translations = $status['translations'];

            unset($status['translations']);

            $projectStatus = ProjectStatus::updateOrCreate(
                [
                    'slug' => $status['slug'],
                ],
                $status
            );

            foreach ($translations as $locale => $name) {
                $language = Language::where('code', $locale)->first();

                if (! $language) {
                    continue;
                }

                $projectStatus->translations()->updateOrCreate(
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

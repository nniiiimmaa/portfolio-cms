<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\ProjectStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectStatusTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = Language::pluck('id', 'code');

        $translations = [
            'planning' => [
                'en' => 'Planning',
                'pt' => 'Planejamento',
                'es' => 'Planificación',
                'de' => 'Planung',
                'tr' => 'Planlama',
                'fa' => 'در حال برنامه‌ریزی',
                'ar' => 'قيد التخطيط',
            ],
            'in-progress' => [
                'en' => 'In Progress',
                'pt' => 'Em Desenvolvimento',
                'es' => 'En Desarrollo',
                'de' => 'In Entwicklung',
                'tr' => 'Geliştiriliyor',
                'fa' => 'در حال توسعه',
                'ar' => 'قيد التطوير',
            ],
            'completed' => [
                'en' => 'Completed',
                'pt' => 'Concluído',
                'es' => 'Completado',
                'de' => 'Abgeschlossen',
                'tr' => 'Tamamlandı',
                'fa' => 'تکمیل شده',
                'ar' => 'مكتمل',
            ],
            'on-hold' => [
                'en' => 'On Hold',
                'pt' => 'Em Espera',
                'es' => 'En Espera',
                'de' => 'Pausiert',
                'tr' => 'Beklemede',
                'fa' => 'متوقف شده',
                'ar' => 'معلق',
            ],
            'archived' => [
                'en' => 'Archived',
                'pt' => 'Arquivado',
                'es' => 'Archivado',
                'de' => 'Archiviert',
                'tr' => 'Arşivlendi',
                'fa' => 'بایگانی شده',
                'ar' => 'مؤرشف',
            ],
        ];

        foreach ($translations as $slug => $items) {
            $status = ProjectStatus::where('slug', $slug)->first();
            foreach ($items as $locale => $name) {
                $status->translations()->updateOrCreate(
                    [
                        'language_id' => $languages[$locale],
                    ],
                    [
                        'name' => $name,
                    ]
                );
            }
        }
    }
}

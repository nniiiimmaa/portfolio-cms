<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = Language::pluck('id', 'code');

        foreach (Project::all() as $project) {

            foreach ($languages as $code => $languageId) {

                $title = match ($code) {
                    'en' => "Project {$project->id}",
                    'pt' => "Projeto {$project->id}",
                    'es' => "Proyecto {$project->id}",
                    'de' => "Projekt {$project->id}",
                    'tr' => "Proje {$project->id}",
                    'fa' => "پروژه {$project->id}",
                    'ar' => "المشروع {$project->id}",
                    default => "Project {$project->id}",
                };

                $description = match ($code) {
                    'en' => fake()->realText(250),
                    'pt' => 'Este é um projeto de demonstração criado para apresentar as funcionalidades do portfólio CMS.',
                    'es' => 'Este es un proyecto de demostración creado para mostrar las funcionalidades del Portfolio CMS.',
                    'de' => 'Dies ist ein Demonstrationsprojekt zur Präsentation der Funktionen des Portfolio CMS.',
                    'tr' => 'Bu proje, Portfolio CMS özelliklerini göstermek için oluşturulmuş örnek bir projedir.',
                    'fa' => 'این یک پروژه نمونه برای نمایش قابلیت‌های سیستم مدیریت نمونه‌کار است.',
                    'ar' => 'هذا مشروع تجريبي لعرض إمكانيات نظام إدارة معرض الأعمال.',
                    default => fake()->realText(250),

                };

                $project->translations()->updateOrCreate(
                    [
                        'language_id' => $languageId,
                    ],
                    [
                        'title' => $title,

                        'description' => $description,
                    ]
                );
            }
        }
    }
}

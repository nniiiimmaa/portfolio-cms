<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $languages = [
            [
                'code' => 'en',
                'name' => 'English',
                'native_name' => 'English',
                'direction' => 'ltr',
                'active' => true,
                'order' => 1,
            ],
            [
                'code' => 'pt',
                'name' => 'Portuguese',
                'native_name' => 'Português',
                'direction' => 'ltr',
                'active' => true,
                'order' => 2,
            ],
            [
                'code' => 'es',
                'name' => 'Spanish',
                'native_name' => 'Español',
                'direction' => 'ltr',
                'active' => true,
                'order' => 3,
            ],
            [
                'code' => 'de',
                'name' => 'German',
                'native_name' => 'Deutsch',
                'direction' => 'ltr',
                'active' => true,
                'order' => 4,
            ],
            [
                'code' => 'tr',
                'name' => 'Turkish',
                'native_name' => 'Türkçe',
                'direction' => 'ltr',
                'active' => true,
                'order' => 5,
            ],
            [
                'code' => 'fa',
                'name' => 'Persian',
                'native_name' => 'فارسی',
                'direction' => 'rtl',
                'active' => true,
                'order' => 6,
            ],
            [
                'code' => 'ar',
                'name' => 'Arabic',
                'native_name' => 'العربية',
                'direction' => 'rtl',
                'active' => true,
                'order' => 7,
            ],
        ];


        foreach ($languages as $language) {
            Language::updateOrCreate(
                [
                    'code' => $language['code'],
                ],
                $language
            );
        }
    }
}

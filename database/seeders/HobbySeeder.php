<?php

namespace Database\Seeders;

use App\Models\Hobby;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hobbies = [
            [
                'slug' => 'photography',
                'icon' => 'pi pi-camera',
                'featured' => true,
                'order' => 1,
            ],
            [
                'slug' => 'gaming',
                'icon' => 'pi pi-desktop',
                'featured' => true,
                'order' => 2,
            ],
            [
                'slug' => 'reading',
                'icon' => 'pi pi-book',
                'featured' => false,
                'order' => 3,
            ],
            [
                'slug' => 'travel',
                'icon' => 'pi pi-globe',
                'featured' => false,
                'order' => 4,
            ],
        ];

        foreach ($hobbies as $hobby) {
            Hobby::updateOrCreate(
                [
                    'slug' => $hobby['slug'],
                ],
                $hobby
            );
        }
    }
}

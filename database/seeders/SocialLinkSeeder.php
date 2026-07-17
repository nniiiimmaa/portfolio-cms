<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SocialLink::updateOrCreate(
            [
                'name' => 'GitHub',
            ],
            [
                'icon' => 'devicon-github-original',
                'url' => 'https://github.com/your-username',
                'username' => 'your-username',
                'color' => '#181717',
                'active' => true,
                'order' => 1,
            ]
        );
    }
}

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
        $socialLinks = [
            [
                'name' => 'GitHub',
                'icon' => null,
                'url' => 'https://github.com/nniiiimmaa',
                'username' => '@nniiiimmaa',
                'color' => '#181717',
                'order' => 1,
            ],
            [
                'name' => 'LinkedIn',
                'icon' => null,
                'url' => 'https://linkedin.com/in/nniiiimmaa',
                'username' => 'nniiiimmaa',
                'color' => '#0A66C2',
                'order' => 2,
            ],
            [
                'name' => 'Twitter / X',
                'icon' => null,
                'url' => 'https://x.com/nniiiimmaa',
                'username' => '@nniiiimmaa',
                'color' => '#000000',
                'order' => 3,
            ],
            [
                'name' => 'Bluesky',
                'icon' => null,
                'url' => 'https://bsky.app/profile/nniiiimmaa',
                'username' => '@nniiiimmaa',
                'color' => '#1185FE',
                'order' => 4,
            ],
            [
                'name' => 'Dev.to',
                'icon' => null,
                'url' => 'https://dev.to/nniiiimmaa',
                'username' => '@nniiiimmaa',
                'color' => '#0A0A0A',
                'order' => 5,
            ],
            [
                'name' => 'Instagram',
                'icon' => null,
                'url' => 'https://instagram.com/nniiiiiimmaa',
                'username' => '@nniiiiiimmaa',
                'color' => '#E4405F',
                'order' => 6,
            ],
            [
                'name' => 'NPM',
                'icon' => null,
                'url' => 'https://npmjs.com/~nniiiimmaa',
                'username' => '~nniiiimmaa',
                'color' => '#CB3837',
                'order' => 7,
            ],
        ];

        foreach ($socialLinks as $socialLink) {
            SocialLink::updateOrCreate(
                [
                    'name' => $socialLink['name'],
                ],
                [
                    ...$socialLink,
                    'active' => true,
                ]
            );
        }
    }
}

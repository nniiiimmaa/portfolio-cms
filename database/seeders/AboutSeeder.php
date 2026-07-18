<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::updateOrCreate(
        [
            'id' => 1,
        ],    
        [
            'available' => true,
            'image' => null,
        ]);
    }
}

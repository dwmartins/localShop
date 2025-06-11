<?php

namespace Database\Seeders;

use App\Models\WebsiteCustomization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteCustomizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebsiteCustomization::create([
            'colors' => json_encode([
                'primary' => '#409EFF',
                'success' => '#67C23A',
                'warning' => '##FFC107',
                'danger' => '#DC3545',
                'link' => '#409EFF'
            ]),
            'default_colors' => json_encode([
                'primary' => '#007bff',
                'success' => '#67C23A',
                'warning' => '#ffc107',
                'danger' => '#dc3545',
                'link' => '#0056b3'
            ]),
            'font_family' => 'Poppins',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ["name" => 'maintenance', "value" => "off"],
            ['name' => 'min_password_length', 'value' => 6],
            ['name' => 'timezone', 'value' => 'America/Sao_Paulo'],
            ['name' => 'date_format', 'value' => 'DD-MM-YYYY'],
            ['name' => 'clock_type', 'value' => 24],
        ];

        foreach ($settings as $setting) {
            Settings::updateOrCreate(
                ['name' => $setting['name']],
                ['value' => $setting['value']]
            );
        }
    }
}

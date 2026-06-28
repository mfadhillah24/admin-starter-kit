<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'app_name' => 'My App',
            'copyright' => '© 2024 My App. All rights reserved.',
            'login_title' => 'Welcome to My App',
        ]);
    }
}

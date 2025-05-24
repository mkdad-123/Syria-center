<?php

namespace Database\Seeders;

use App\Enums\SectionEnum;
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
        foreach (SectionEnum::cases() as $section) {
            Setting::factory()->create(['section' => $section]);
        }
    }
}

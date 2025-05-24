<?php

namespace Database\Factories;

use App\Enums\SectionEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'section' => $this->faker->randomElement(SectionEnum::cases()),
            'title' => [
                'en' => $this->faker->sentence(3),
                'ar' => $this->faker->sentence(3)
            ],
            'content' => [
                'en' => $this->faker->paragraph(3),
                'ar' => $this->faker->paragraph(3),
            ],
            'image' => $this->faker->imageUrl(640, 480, 'business'),
            'extra' => [
                'key1' => $this->faker->word(),
                'key2' => $this->faker->boolean(),
            ],
        ];
    }
}

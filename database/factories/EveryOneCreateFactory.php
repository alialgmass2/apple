<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EveryOneCreate>
 */
class EveryOneCreateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $index = 1;
        $num = $index++;
        return [
            'text_en' => $this->faker->paragraph(5),
            'text_ar' => $this->faker->paragraph(5),
            // 'text_2_en' => $this->faker->paragraph(5),
            // 'text_2_ar' => $this->faker->paragraph(5),
            'findout_link' => $this->faker->url(),
            'download_link' => $this->faker->url(),
        ];
    }
}

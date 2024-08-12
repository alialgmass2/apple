<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EveryOneCode>
 */
class EveryOneCodeFactory extends Factory
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
            'title_en' => 'Title ' . $num,
            'title_ar' => 'Title ' . $num,
            'text_en' => $this->faker->paragraph(5),
            'text_ar' => $this->faker->paragraph(5),
            'url' => $this->faker->url(),
        ];
    }
}

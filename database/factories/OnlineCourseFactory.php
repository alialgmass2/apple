<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OnlineCourse>
 */
class OnlineCourseFactory extends Factory
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
            'title_en' => $this->faker->sentence(),
            'title_ar' => $this->faker->sentence(),
            'title_2_en' => $this->faker->paragraph(5),
            'title_2_ar' => $this->faker->paragraph(5),
        ];
    }
}

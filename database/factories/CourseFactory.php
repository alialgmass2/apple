<?php

namespace Database\Factories;

use App\Models\EducationLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'education_level_id' => EducationLevel::inRandomOrder()->first()->id,
            'title_en' => $this->faker->sentence(),
            'title_ar' => $this->faker->sentence(),
            'estimated_time' => rand(1,100),
            'brief_en' => $this->faker->sentence(20),
            'brief_ar' => $this->faker->sentence(20),
            'what_will_learn_en' => $this->faker->paragraph(10),
            'what_will_learn_ar' => $this->faker->paragraph(10),
            'content_en' => $this->faker->paragraph(10),
            'content_ar' => $this->faker->paragraph(10),
            'requirements_en' => $this->faker->paragraph(10),
            'requirements_ar' => $this->faker->paragraph(10),
            'description_en' => $this->faker->paragraph(10),
            'description_ar' => $this->faker->paragraph(10),
            'about_en' => $this->faker->paragraph(10),
            'about_ar' => $this->faker->paragraph(10),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeadershipIntro>
 */
class LeadershipIntroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'title_en' => $this->faker->sentence(),
            'title_ar' => $this->faker->sentence(),
            'text_en' => $this->faker->paragraph(),
            'text_ar' => $this->faker->paragraph(),
        ];

    }
}

<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HowTo>
 */
class HowToFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->first()->id,
            'title_en' => $this->faker->sentence(),
            'title_ar' => $this->faker->sentence(),
            'text_en' => $this->faker->paragraph(5),
            'text_ar' => $this->faker->paragraph(5),
        ];

    }
}

<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class productFactory extends Factory
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
            'category_id' => Category::inRandomOrder()->first()->id,
            'sub_category_id' => SubCategory::inRandomOrder()->first()->id,
            'title_en' => 'Title ' . $num,
            'title_ar' => 'Title ' . $num,
            'description_en' => $this->faker->paragraph(5),
            'description_ar' => $this->faker->paragraph(5),
            'features_en' => $this->faker->paragraph(5),
            'features_ar' => $this->faker->paragraph(5),
            'video_en' => $this->faker->url(),
            'video_ar' => $this->faker->url(),
            'price' => rand(1,100),
            'discount' => rand(0,10),
        ];
    }
}

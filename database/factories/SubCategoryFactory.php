<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
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
            'name_en' => 'Sub Cat Name ' . $num,
            'name_ar' => 'Sub Cat Name ' . $num,
        ];
    }
}

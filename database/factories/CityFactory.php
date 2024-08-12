<?php

namespace Database\Factories;

use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
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
            'region_id' => Region::inRandomOrder()->first()->id,
            'name_en' => 'City ' . $num,
            'name_ar' => 'City ' . $num,
        ];
    }
}

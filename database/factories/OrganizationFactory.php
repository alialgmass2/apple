<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\EducationLevel;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
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
            'education_level_id' => EducationLevel::inRandomOrder()->first()->id,
            'region_id' => Region::inRandomOrder()->first()->id,
            'city_id' => City::inRandomOrder()->first()->id,
            'name_en' => 'Organization Name ' . $num,
            'name_ar' => 'Organization Name ' . $num,
            'domain' => 'something.com'. $num,
            'email' => $this->faker->safeEmail(),
            'password' => 123456,
        ];
    }
}

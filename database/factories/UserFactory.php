<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\EducationLevel;
use App\Models\Organization;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_type' => $this->faker->randomElement(['STUDENT','TEACHER']),
            'region_id' => Region::inRandomOrder()->first()->id,
            'city_id' => City::inRandomOrder()->first()->id,
            'education_level_id' => EducationLevel::inRandomOrder()->first()->id,
            'organization_id' => Organization::inRandomOrder()->first()->id,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'otp' => rand(1111,9999),
            'otp_verified' => rand(0,1),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

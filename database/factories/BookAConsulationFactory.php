<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookAConsulation>
 */
class BookAConsulationFactory extends Factory
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
    'role_id' => Role::inRandomOrder()->first()->id,
    'name' => 'Name' . $num,
    'email' => $this->faker->safeEmail(),
    'institution' => $this->faker->word(),
    'phone' => $this->faker->phoneNumber(),
    'message' => $this->faker->paragraph(5),
];
}
}

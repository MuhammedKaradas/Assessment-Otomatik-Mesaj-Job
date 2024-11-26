<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MessageContact>
 */
class MessageContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => "Jonh".$this->faker->randomNumber(),
            'surname' => "Doe".$this->faker->randomNumber(),
            'area_code' => "90",
            'phone_number' => $this->faker->numerify('##########'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

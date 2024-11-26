<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MessageTemplate>
 */
class MessageTemplateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'template_code' => "welcome_".$this->faker->randomNumber(),
            'template_message' => "Hoşgeldiniz Sayın Müşterimiz",
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

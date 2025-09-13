<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MindFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'about' => $this->faker->sentence(12), // short bio
            'photo' => 'default.png',
        ];
    }
}

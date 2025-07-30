<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(5),
            'category' => $this->faker->randomElement([
                'budget meals',
                'quick recipes',
                'no-cook meals',
                '5-ingredient recipes',
                'leftover hacks',
            ]),
            'user_id' => User::factory(),
        ];
    }
}


<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            // product_id & user_id diisi dari seeder
            'rating' => fake()->numberBetween(1, 5),
            'comment' => fake()->sentence(12),
        ];
    }
}
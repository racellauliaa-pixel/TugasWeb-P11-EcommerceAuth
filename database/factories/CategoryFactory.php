<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Pakaian Pria', 'Pakaian Wanita', 'Sepatu', 'Sandal', 'Tas',
            'Aksesoris', 'Elektronik', 'Peralatan Rumah Tangga', 'Kosmetik & Skincare',
            'Olahraga', 'Buku & Alat Tulis', 'Mainan Anak',
        ]) . ' ' . fake()->unique()->numberBetween(1, 9999);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->sentence(10),
        ];
    }
}
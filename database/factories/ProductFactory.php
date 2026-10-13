<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $adjectives = ['Premium', 'Classic', 'Trendy', 'Elegant', 'Super', 'Everyday', 'Limited Edition', 'Basic', 'Deluxe', 'Pro'];
        $nouns = ['Shirt', 'Jacket', 'Sneakers', 'Backpack', 'Watch', 'Wallet', 'Headset', 'Blender', 'Lamp', 'Notebook', 'Chair', 'Mug'];

        $name = fake()->randomElement($adjectives) . ' ' . fake()->randomElement($nouns) . ' ' . fake()->unique()->numberBetween(1, 99999);

        return [
            // category_id & created_by sengaja TIDAK di-set di sini,
            // supaya wajib diisi eksplisit dari ProductSeeder (lebih kontrol & realistis)
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->paragraph(3),
            'price' => fake()->numberBetween(15, 2500) * 1000, // Rp15.000 - Rp2.500.000
            'stock' => fake()->numberBetween(0, 150),
            'image' => null,
        ];
    }

    /** State: produk yang stoknya habis, berguna untuk uji scopeInStock() */
    public function outOfStock(): static
    {
        return $this->state(fn () => ['stock' => 0]);
    }
}
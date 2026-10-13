<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Bikin 60 produk (lebih dari syarat minimal 50), tersebar acak
     * ke semua kategori, dengan 'created_by' random antara admin & editor.
     */
    public function run(): void
    {
        $categories = Category::all();
        $creators = User::whereIn('role', ['admin', 'editor'])->get();
        $buyers = User::all();

        if ($categories->isEmpty() || $creators->isEmpty()) {
            $this->command->warn('Jalankan CategorySeeder & UserRoleSeeder dulu sebelum ProductSeeder.');
            return;
        }

        Product::factory()
            ->count(60)
            ->make()
            ->each(function (Product $product) use ($categories, $creators, $buyers) {
                $product->category_id = $categories->random()->id;
                $product->created_by = $creators->random()->id;
                $product->save();

                // Setiap produk dikasih 0-4 review acak biar relasi reviews() ada isinya
                Review::factory()
                    ->count(rand(0, 4))
                    ->create([
                        'product_id' => $product->id,
                        'user_id' => $buyers->random()->id,
                    ]);
            });

        // Beberapa produk sengaja dibikin stok 0 untuk menguji scopeInStock()
        Product::inRandomOrder()->limit(5)->update(['stock' => 0]);
    }
}
<?php

/**
 * Sara Vasquez
 */

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create categories and products
        $categories = Category::factory()->count(10)->active()->create();

        foreach ($categories as $category) {
            Product::factory()
                ->count(rand(3, 8))
                ->forCategory($category->getId())
                ->active()
                ->create();

            Product::factory()
                ->count(rand(1, 3))
                ->forCategory($category->getId())
                ->lowStock()
                ->active()
                ->create();

            Product::factory()
                ->count(rand(0, 2))
                ->forCategory($category->getId())
                ->outOfStock()
                ->create();
        }

        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@urbanthreads.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'address' => 'Calle 1 # 1-1',
                'budget' => 0,
            ]
        );

        // Create regular users
        User::factory()->count(10)->create();
    }
}

<?php

/**
 * Sara Vasquez
 */

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $clothingCategories = [
            'Camisetas',
            'Pantalones',
            'Chaquetas',
            'Sudaderas',
            'Shorts',
            'Vestidos',
            'Faldas',
            'Abrigos',
            'Ropa Deportiva',
            'Ropa Interior',
            'Accesorios',
            'Gorras',
            'Zapatos',
            'Bolsos',
            'Calcetines',
            'Bufandas',
            'Cinturones',
            'Gafas',
            'Relojes',
            'Joyería',
        ];

        return [
            'name' => $this->faker->unique()->randomElement($clothingCategories),
            'description' => $this->faker->sentence(10),
            'state' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'state' => 'active',
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'state' => 'inactive',
        ]);
    }
}

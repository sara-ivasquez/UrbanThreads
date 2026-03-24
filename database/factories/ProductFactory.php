<?php

/**
 * Sara Vasquez
 */

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $clothingProducts = [
            'Camiseta Urbana' => [
                'desc' => 'Camiseta de algodón con diseño urbano moderno.',
                'price' => [200, 800],
            ],
            'Pantalón Cargo' => [
                'desc' => 'Pantalón cargo con múltiples bolsillos y corte moderno.',
                'price' => [800, 900],
            ],
            'Chaqueta Street' => [
                'desc' => 'Chaqueta estilo streetwear con capucha desmontable.',
                'price' => [500, 600],
            ],
            'Sudadera Oversize' => [
                'desc' => 'Sudadera oversize con estampado urbano exclusivo.',
                'price' => [200, 400],
            ],
            'Shorts Deportivos' => [
                'desc' => 'Shorts deportivos con tecnología de secado rápido.',
                'price' => [200, 400],
            ],
            'Vestido Casual' => [
                'desc' => 'Vestido casual con diseño urbano y tela transpirable.',
                'price' => [600, 1800],
            ],
            'Abrigo Invierno' => [
                'desc' => 'Abrigo de invierno con relleno térmico y estilo urbano.',
                'price' => [200, 600],
            ],
            'Gorra Snapback' => [
                'desc' => 'Gorra snapback con bordado exclusivo.',
                'price' => [250, 800],
            ],
            'Zapatillas Urban' => [
                'desc' => 'Zapatillas urbanas con suela de goma y diseño moderno.',
                'price' => [1500, 5000],
            ],
            'Bolso Crossbody' => [
                'desc' => 'Bolso crossbody con compartimentos organizadores.',
                'price' => [600, 1000],
            ],
        ];

        $productType = $this->faker->randomElement(array_keys($clothingProducts));
        $productInfo = $clothingProducts[$productType];
        $productTitle = $productType.' '.$this->faker->randomNumber(3, true);
        $price = $this->faker->numberBetween($productInfo['price'][0], $productInfo['price'][1]);
        $description = $productInfo['desc'].' '.$this->faker->sentence(5);

        return [
            'title' => $productTitle,
            'description' => $description,
            'category_id' => Category::inRandomOrder()->first()?->getId() ?? 1,
            'image' => 'default.png',
            'price' => $price,
            'stock' => $this->faker->numberBetween(0, 100),
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

    public function forCategory(int $categoryId): static
    {
        return $this->state(fn (array $attributes) => [
            'category_id' => $categoryId,
        ]);
    }

    public function highStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock' => $this->faker->numberBetween(50, 200),
        ]);
    }

    public function lowStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock' => $this->faker->numberBetween(1, 10),
        ]);
    }

    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock' => 0,
        ]);
    }
}

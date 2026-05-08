<?php

/**
 * Sara Vasquez
 */

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function test_product_getters_and_setters(): void
    {
        $product = new Product;
        $product->setTitle('Urban Black Hoodie');
        $product->setDescription('Premium black hoodie with urban design');
        $product->setPrice(80000);
        $product->setStock(20);
        $product->setState('active');
        $product->setCategoryId(1);
        $product->setImage('hoodie.png');

        $this->assertEquals('Urban Black Hoodie', $product->getTitle());
        $this->assertEquals('Premium black hoodie with urban design', $product->getDescription());
        $this->assertEquals(80000, $product->getPrice());
        $this->assertEquals(20, $product->getStock());
        $this->assertEquals('active', $product->getState());
        $this->assertEquals(1, $product->getCategoryId());
        $this->assertEquals('hoodie.png', $product->getImage());
    }

    public function test_sum_prices_by_quantities(): void
    {
        $product1 = new Product;
        $product1->setPrice(50000);

        $product2 = new Product;
        $product2->setPrice(30000);

        // Simulate session cart
        $productsInSession = [0 => 2, 1 => 1];
        $products = new Collection([$product1, $product2]);

        $product1->setAttribute('id', 0);
        $product2->setAttribute('id', 1);

        $total = Product::sumPricesByQuantities($products, $productsInSession);

        $this->assertEquals(130000, $total);
    }
}

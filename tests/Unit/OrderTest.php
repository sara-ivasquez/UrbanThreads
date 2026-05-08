<?php

/**
 * Sara Vasquez
 */

namespace Tests\Unit;

use App\Models\Order;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function test_order_getters_and_setters(): void
    {
        $order = new Order;
        $order->setTotalPrice(150000);
        $order->setState('pending');
        $order->setUserId(1);

        $this->assertEquals(150000, $order->getTotalPrice());
        $this->assertEquals('pending', $order->getState());
        $this->assertEquals(1, $order->getUserId());
    }

    public function test_order_state_can_be_updated(): void
    {
        $order = new Order;
        $order->setState('pending');
        $this->assertEquals('pending', $order->getState());

        $order->setState('dispatched');
        $this->assertEquals('dispatched', $order->getState());
    }
}

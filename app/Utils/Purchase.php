<?php
/**
 * Sara Vasquez
 */

namespace App\Utils;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class Purchase
{
    public static function process(int $userId, array $productsInSession): array
    {
        try {
            $user = User::find($userId);
            $products = Product::findMany(array_keys($productsInSession));

            $total = 0;
            foreach ($products as $product) {
                $quantity = $productsInSession[$product->getId()];
                if ($quantity > $product->getStock()) {
                    $quantity = $product->getStock();
                }
                if ($quantity <= 0) {
                    continue;
                }
                $total += ($product->getPrice() * $quantity);
            }

            if ($user->getBudget() < $total) {
                return [
                    'status' => 'insufficient_funds',
                    'budget' => $user->getBudget(),
                    'total' => $total,
                ];
            }

            $order = new Order;
            $order->setUserId($userId);
            $order->setTotalPrice(0);
            $order->setState('pending');
            $order->save();

            $items = [];
            $stockAvailable = false;

            foreach ($products as $product) {
                $quantity = $productsInSession[$product->getId()];
                if ($quantity > $product->getStock()) {
                    $quantity = $product->getStock();
                }
                if ($quantity <= 0) {
                    continue;
                }
                $stockAvailable = true;

                $item = new Item;
                $item->setQuantity($quantity);
                $item->setPrice($product->getPrice());
                $item->setProductId($product->getId());
                $item->setOrderId($order->getId());
                $item->save();
                $items[] = $item;

                $product->setStock($product->getStock() - $quantity);
                $product->save();
            }

            if (! $stockAvailable || $total <= 0) {
                $order->delete();
                return [
                    'status' => 'error',
                ];
            }

            $order->setTotalPrice($total);
            $order->save();

            $user->setBudget($user->getBudget() - $total);
            $user->save();

            return [
                'status' => 'success',
                'order' => $order,
            ];

        } catch (\Exception $e) {
            if (isset($order) && $order->exists) {
                if (isset($items) && ! empty($items)) {
                    foreach ($items as $item) {
                        $item->delete();
                    }
                }
                $order->delete();
            }
            return [
                'status' => 'error',
            ];
        }
    }
}
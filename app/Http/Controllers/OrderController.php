<?php

namespace App\Http\Controllers;

// Made by: Franchesca Garcia

use App\Http\Requests\OrderPurchaseRequest;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function purchase(OrderPurchaseRequest $request): RedirectResponse
    {
        $product = Product::findOrFail((int) $request->input('product_id'));
        $quantity = (int) $request->input('quantity');

        DB::transaction(function () use ($product, $quantity): void {
            $order = new Order;
            $order->setUserId((int) Auth::id());
            $order->setState('pending');
            $order->setTotalPrice($product->getPrice() * $quantity);
            $order->save();

            $item = new Item;
            $item->setQuantity($quantity);
            $item->setPrice($product->getPrice());
            $item->setProductId($product->getId());
            $item->setOrderId($order->getId());
            $item->save();

            $product->setStock($product->getStock() - $quantity);
            $product->save();
        });

        return redirect()
            ->route('user.orders')
            ->with('success', __('app.order.purchase.success'));
    }
}

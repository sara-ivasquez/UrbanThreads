<?php

namespace App\Http\Controllers;

// Made by: Franchesca Garcia

use App\Http\Requests\OrderPurchaseRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function purchase(OrderPurchaseRequest $request): RedirectResponse
    {
        $product = Product::findOrFail((int) $request->input('product_id'));
        $quantity = (int) $request->input('quantity');

        if (! Order::canBePurchased($product, $quantity)) {
            return redirect()->route('product.show', ['id' => $product->getId()]);
        }

        Order::createFromProduct($product, $quantity, (int) Auth::id());

        return redirect()->route('user.orders');
    }
}

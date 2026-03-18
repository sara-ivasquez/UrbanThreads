<?php

/**
 * Sara Vasquez
 */

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function show(): View
    {
        $user = User::findOrFail(Auth::id());
        $viewData = [
            'title' => $user->getName().' - '.__('app.user.show.title_suffix'),
            'user' => $user,
        ];

        return view('user.show')->with('viewData', $viewData);
    }

    public function orders(): View
    {
        $user = User::findOrFail(Auth::id());
        $viewData = [
            'title' => __('app.user.orders.title'),
            'subtitle' => __('app.user.orders.subtitle'),
            'orders' => Order::with(['items.product'])->where('user_id', $user->getId())->get(),
        ];

        return view('user.orders')->with('viewData', $viewData);
    }
}

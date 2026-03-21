<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller implements HasMiddleware
{
    use AuthenticatesUsers;

    public static function middleware(): array
    {
        return [
            new Middleware('guest', except: ['logout']),
            new Middleware('auth', only: ['logout']),
        ];
    }

    protected function redirectTo()
    {
        if (Auth::check()) {
            $user = User::find(Auth::id());
            if ($user && $user->getRole() == 'admin') {
                return '/admin/home';
            }
        }

        return '/';
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class CartServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Share cart count with all views
        View::composer('*', function ($view) {
            $cart = session()->get('cart', []);
            $cartCount = array_sum(array_column($cart, 'quantity'));
            $view->with('cartCount', $cartCount);
        });
    }
}
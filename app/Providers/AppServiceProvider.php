<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Share wishlist count with all views
        View::composer('*', function ($view) {
            $wishlistCount = session()->has('wishlist') ? count(session('wishlist')) : 0;
            $view->with('wishlistCount', $wishlistCount);
        });
    }
}

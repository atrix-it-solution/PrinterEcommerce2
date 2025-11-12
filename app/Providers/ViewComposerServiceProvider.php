<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Product\ProductCategory;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Share categories with specific views that need them
        View::composer([
            'layouts.frontend.header', 
            'layouts.frontend.master',
            'pages.frontend.shop',
            'pages.frontend.home'
        ], function ($view) {
            $categories = ProductCategory::withCount('products')->get();
            $view->with('categories', $categories);
        });
    }
}
<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;

class HomeController extends Controller
{
    public function index()
    {
        // For trending products section (using latest products)
        $products = Product::with(['categories', 'featuredImage'])
            ->inRandomOrder()
            ->limit(12) // Adjust limit as needed
            ->get();

        // For featured products section
        $featuredProducts = Product::with(['categories', 'featuredImage'])
            ->limit(8)
            ->get();

        // For latest products section (if needed separately)
        $products = Product::with(['featuredImage'])
            ->inRandomOrder()
            ->limit(8)
            ->get();

        $categories = ProductCategory::with('categoryImage')
            ->withCount('products')
            ->having('products_count', '>', 0)
            ->limit(10)
            ->get();

        return view('pages.frontend.home', compact('products', 'featuredProducts', 'products', 'categories'));
        // $products = Product::with(['categories', 'featuredImage'])->get();
        // $categories = ProductCategory::with('categoryImage') ->withCount('products')->get();
        // return view('pages.frontend.home', compact('products', 'categories'));
    }
   
}

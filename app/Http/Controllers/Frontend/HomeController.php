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
        $products = Product::with(['categories', 'featuredImage'])->get();
        $categories = ProductCategory::with('categoryImage') ->withCount('products')->get();
        return view('pages.frontend.home', compact('products', 'categories'));
    }
   
}

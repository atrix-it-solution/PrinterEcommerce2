<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\ProductCategory;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::with('categoryImage')->get(); // Load relationship
        $editCategory = null;
        
        return view('pages.dashboard.product.product_category.index', compact('categories', 'editCategory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:product_categories,slug',
            'description' => 'nullable|string',
            'category_image' => 'nullable|exists:media,id',
        ]);

        ProductCategory::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'category_image' => $request->category_image,
        ]);

        return redirect()->route('productcategories.index')->with('success', 'Product category created successfully!');
    }

    public function edit($id)
    {
        $editCategory = ProductCategory::with('categoryImage')->findOrFail($id); // Load relationship
        $categories = ProductCategory::with('categoryImage')->get(); // Load relationship

        return view('pages.dashboard.product.product_category.index', compact('editCategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:product_categories,slug,' . $id,
            'description' => 'nullable|string',
            'category_image' => 'nullable|exists:media,id',
        ]);

        $category->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'category_image' => $request->category_image,
        ]);

        return redirect()->route('productcategories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $productCategory = ProductCategory::findOrFail($id);
        $productCategory->delete();

        return redirect()
            ->route('productcategories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
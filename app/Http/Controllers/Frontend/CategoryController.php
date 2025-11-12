<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\ProductCategory;
use App\Models\Product\Product;

class CategoryController extends Controller
{
    /**
     * Display all categories
     */
    public function index()
    {
        $categories = ProductCategory::with(['categoryImage', 'products'])->get();
        
        return view('pages.frontend.category', compact('categories'));
    }

    /**
     * Display products for a specific category
     */
    public function show($slug, Request $request)
    {
        $category = ProductCategory::where('slug', $slug)->firstOrFail();
        
        // Get products for this category with filters
        $products = $this->getCategoryProducts($category, $request);
        
        // Get all categories for sidebar
        $categories = ProductCategory::withCount(['products' => function($query) {
            $query->where(function($q) {
                $q->where('stock_quantity', '>', 0)->orWhereNull('stock_quantity');
            });
        }])->get();

        // Get counts for availability filters
        $counts = $this->getProductCounts($category);

        if ($request->ajax()) {
            return response()->json([
                'products' => $this->formatProducts($products->items()),
                'pagination' => $this->formatPagination($products),
                'total_products' => $products->total(),
                'filters' => $this->getActiveFilters($request)
            ]);
        }

        return view('pages.frontend.category', array_merge(
            compact('category', 'products', 'categories'),
            $counts
        ));
    }

    private function getCategoryProducts($category, Request $request)
    {
        $query = Product::with(['categories', 'featuredImage'])
            ->whereHas('categories', function($q) use ($category) {
                $q->where('product_categories.id', $category->id);
            });

        // Availability filter
        if ($request->has('availability') && !empty($request->availability)) {
            if (in_array('sale', $request->availability)) {
                $query->whereNotNull('sale_price')->where('sale_price', '>', 0);
            }
            if (in_array('instock', $request->availability)) {
                $query->where(function($q) {
                    $q->where('stock_quantity', '>', 0)
                      ->orWhereNull('stock_quantity');
                });
            }
            if (in_array('outstock', $request->availability)) {
                $query->where('stock_quantity', 0);
            }
        }

        // Price filter
        $minPrice = $request->get('min_price', 0);
        $maxPrice = $request->get('max_price', 10000);
        
        $query->where(function($q) use ($minPrice, $maxPrice) {
            $q->whereBetween('regular_price', [$minPrice, $maxPrice])
              ->orWhereBetween('sale_price', [$minPrice, $maxPrice]);
        });

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOptions = [
            'created_at' => ['field' => 'created_at', 'direction' => 'desc'],
            'name_asc' => ['field' => 'title', 'direction' => 'asc'],
            'name_desc' => ['field' => 'title', 'direction' => 'desc'],
            'price_asc' => ['field' => 'sale_price', 'direction' => 'asc'],
            'price_desc' => ['field' => 'sale_price', 'direction' => 'desc'],
        ];

        $sortConfig = $sortOptions[$sortBy] ?? $sortOptions['created_at'];
        
        return $query->orderBy($sortConfig['field'], $sortConfig['direction'])
                    ->paginate(6)
                    ->withQueryString();
    }

    private function getProductCounts($category)
    {
        $baseQuery = Product::whereHas('categories', function($q) use ($category) {
            $q->where('product_categories.id', $category->id);
        });

        return [
            'totalProducts' => $baseQuery->count(),
            'saleProductsCount' => $baseQuery->whereNotNull('sale_price')->where('sale_price', '>', 0)->count(),
            'inStockCount' => $baseQuery->where(function($q) {
                $q->where('stock_quantity', '>', 0)->orWhereNull('stock_quantity');
            })->count(),
            'outOfStockCount' => $baseQuery->where('stock_quantity', 0)->count(),
        ];
    }

    private function formatProducts($products)
    {
        return collect($products)->map(function($product) {
            $discount = null;
            if ($product->sale_price && $product->regular_price) {
                $discount = round((($product->regular_price - $product->sale_price) / $product->regular_price) * 100);
            }

            return [
                'id' => $product->id,
                'title' => $product->title,
                'slug' => $product->slug,
                'regular_price' => number_format($product->regular_price, 2),
                'sale_price' => $product->sale_price ? number_format($product->sale_price, 2) : null,
                'image' => $product->featuredImage ? asset($product->featuredImage->url) : asset('assets/frontend/images/placeholder.jpg'),
                'discount' => $discount,
                'url' => route('product.show', $product->slug)
            ];
        })->toArray();
    }

    private function formatPagination($products)
    {
        return [
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'per_page' => $products->perPage(),
            'total' => $products->total(),
            'prev_url' => $products->previousPageUrl(),
            'next_url' => $products->nextPageUrl(),
            'pages' => $products->getUrlRange(1, $products->lastPage())
        ];
    }

    private function getActiveFilters($request)
    {
        $filters = [];
        
        if ($request->has('availability') && !empty($request->availability)) {
            $filters['availability'] = $request->availability;
        }
        
        if ($request->has('min_price') || $request->has('max_price')) {
            $filters['price'] = [
                'min' => $request->get('min_price', 0),
                'max' => $request->get('max_price', 10000)
            ];
        }

        return $filters;
    }
}
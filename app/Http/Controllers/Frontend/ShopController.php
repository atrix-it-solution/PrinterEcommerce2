<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        \Log::info('ShopController accessed', ['request' => $request->all()]);

        try {
            // Get categories for filter sidebar - REMOVED STATUS CHECK
            $categories = ProductCategory::withCount(['products'])->get();

            // Get filtered products
            $products = $this->getFilteredProducts($request);

            // Get counts for availability filters
            $counts = $this->getProductCounts();

            \Log::info('Products loaded', [
                'total' => $products->total(),
                'count' => $products->count(),
                'current_page' => $products->currentPage()
            ]);

            // For AJAX requests (filtering/sorting)
            if ($request->ajax()) {
                return response()->json([
                    'products' => $this->formatProducts($products->items()),
                    'pagination' => $this->formatPagination($products),
                    'total_products' => $products->total(),
                    'success' => true
                ]);
            }

            // For normal page loads
            return view('pages.frontend.shop', array_merge(
                compact('products', 'categories'),
                $counts
            ));

        } catch (\Exception $e) {
            \Log::error('ShopController error: ' . $e->getMessage());

            // Return error response for AJAX
            if ($request->ajax()) {
                return response()->json([
                    'error' => 'Failed to load products: ' . $e->getMessage(),
                    'success' => false
                ], 500);
            }

            // Return error view for normal requests - REMOVED STATUS CHECK
            return view('pages.frontend.shop', [
                'products' => Product::paginate(6),
                'categories' => ProductCategory::all(), // Removed status filter
                'saleProductsCount' => 0,
                'inStockCount' => 0,
                'outOfStockCount' => 0,
            ]);
        }
    }

    private function getFilteredProducts(Request $request)
    {
        // Start with base query
        $query = Product::with(['categories', 'featuredImage']);

        \Log::info('Base query products count: ' . $query->count());

        // === CATEGORY FILTER ===
        if ($request->has('category') && !empty($request->category)) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->whereIn('product_categories.id', $request->category);
            });
            \Log::info('Applied category filter', ['categories' => $request->category]);
        }

        // === AVAILABILITY FILTER ===
        if ($request->has('availability') && !empty($request->availability)) {
            if (in_array('sale', $request->availability)) {
                $query->whereNotNull('sale_price')->where('sale_price', '>', 0);
            }
            
            if (in_array('instock', $request->availability)) {
                $query->where(function($q) {
                    $q->where('stock_quantity', '>', 0)->orWhereNull('stock_quantity');
                });
            }
            
            if (in_array('outstock', $request->availability)) {
                $query->where('stock_quantity', 0);
            }
            \Log::info('Applied availability filter', ['availability' => $request->availability]);
        }

        // === PRICE FILTER ===
        $minPrice = $request->get('min_price', 0);
        $maxPrice = $request->get('max_price', 10000);
        
        if ($minPrice > 0 || $maxPrice < 10000) {
            $query->where(function($q) use ($minPrice, $maxPrice) {
                $q->whereBetween('regular_price', [$minPrice, $maxPrice])
                  ->orWhere(function($q2) use ($minPrice, $maxPrice) {
                      $q2->whereNotNull('sale_price')
                         ->where('sale_price', '>', 0)
                         ->whereBetween('sale_price', [$minPrice, $maxPrice]);
                  });
            });
            \Log::info('Applied price filter', ['min' => $minPrice, 'max' => $maxPrice]);
        }

        // === SORTING ===
        $sortBy = $request->get('sort_by', 'created_at');
        
        switch ($sortBy) {
            case 'name_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('regular_price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('regular_price', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        \Log::info('Final query before pagination', ['sort' => $sortBy]);

        // Get user's wishlist product IDs
        $wishlistProductIds = [];
        if (auth()->check()) {
            $wishlistProductIds = auth()->user()->wishlist()->pluck('product_id')->toArray();
        }

        // Transform products to include wishlist status
        $products = $query->paginate(6)->withQueryString();
        
        $products->getCollection()->transform(function ($product) use ($wishlistProductIds) {
            $product->in_wishlist = in_array($product->id, $wishlistProductIds);
            return $product;
        });

        return $products;
    }

    private function getProductCounts()
    {
        return [
            'saleProductsCount' => Product::whereNotNull('sale_price')
                                         ->where('sale_price', '>', 0)
                                         ->count(),
            'inStockCount' => Product::where(function($q) {
                $q->where('stock_quantity', '>', 0)
                  ->orWhereNull('stock_quantity');
            })->count(),
            'outOfStockCount' => Product::where('stock_quantity', 0)->count(),
        ];
    }

    private function formatProducts($products)
{
    // Get user's wishlist product IDs for AJAX requests
    $wishlistProductIds = [];
    if (auth()->check()) {
        $wishlistProductIds = auth()->user()->wishlist()->pluck('product_id')->toArray();
    }

    \Log::info('Wishlist Product IDs:', $wishlistProductIds);
    \Log::info('Products to format:', ['count' => count($products)]);

    return collect($products)->map(function($product) use ($wishlistProductIds) {
        // Calculate discount percentage
        $discount = null;
        if ($product->sale_price && 
            $product->regular_price && 
            $product->sale_price < $product->regular_price) {
            $discount = round((($product->regular_price - $product->sale_price) / $product->regular_price) * 100);
        }

        // Get image URL with fallback
        $imageUrl = $product->featuredImage 
            ? asset($product->featuredImage->url)
            : asset('assets/frontend/images/placeholder.jpg');

        // Check if product is in wishlist - USE THE TRANSFORMED DATA
        // The product should have in_wishlist property from getFilteredProducts method
        $inWishlist = $product->in_wishlist ?? in_array($product->id, $wishlistProductIds);

        \Log::info("Product {$product->id} wishlist status:", [
            'product_id' => $product->id,
            'in_wishlist_property' => $product->in_wishlist ?? 'not_set',
            'in_array_result' => in_array($product->id, $wishlistProductIds),
            'final_status' => $inWishlist
        ]);

        return [
            'id' => $product->id,
            'title' => $product->title,
            'slug' => $product->slug,
            'regular_price' => number_format($product->regular_price, 2),
            'sale_price' => $product->sale_price ? number_format($product->sale_price, 2) : null,
            'image' => $imageUrl,
            'discount' => $discount,
            'url' => route('product.show', $product->slug),
            'in_stock' => $product->stock_quantity > 0 || is_null($product->stock_quantity),
            'in_wishlist' => $inWishlist 
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
}
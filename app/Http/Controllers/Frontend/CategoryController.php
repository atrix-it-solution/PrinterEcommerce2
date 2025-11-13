<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\ProductCategory;
use App\Models\Product\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        
        try {
            // Get products for this category with filters
            $products = $this->getCategoryProducts($category, $request);
            
            // Get counts for availability filters
            $counts = $this->getProductCounts($category);

            // For AJAX requests (filtering/sorting)
            if ($request->ajax()) {
                return response()->json([
                    'success' => true, // ADD THIS - JavaScript expects this
                    'products' => $this->formatProducts($products->items()),
                    'pagination' => $this->formatPagination($products),
                    'total_products' => $products->total()
                ]);
            }

            // For normal page loads
            return view('pages.frontend.category', array_merge(
                compact('category', 'products'),
                $counts
            ));

        } catch (\Exception $e) {
            Log::error('CategoryController error: ' . $e->getMessage());

            // Return error response for AJAX
            if ($request->ajax()) {
                return response()->json([
                    'success' => false, // ADD THIS
                    'error' => 'Failed to load products: ' . $e->getMessage()
                ], 500);
            }

            // Return error view for normal requests
            return view('pages.frontend.category', [
                'category' => $category,
                'products' => $category->products()->paginate(6),
                'saleProductsCount' => 0,
                'inStockCount' => 0,
                'outOfStockCount' => 0,
            ]);
        }
    }

    private function getCategoryProducts($category, Request $request)
    {
        $query = Product::with(['categories', 'featuredImage'])
            ->whereHas('categories', function($q) use ($category) {
                $q->where('product_categories.id', $category->id);
            });

        // Availability filter
        if ($request->has('availability') && !empty($request->availability)) {
            $availabilities = is_array($request->availability) ? $request->availability : [$request->availability];
            
            $query->where(function($q) use ($availabilities) {
                foreach ($availabilities as $availability) {
                    switch ($availability) {
                        case 'sale':
                            $q->orWhere(function($q2) {
                                $q2->whereNotNull('sale_price')
                                   ->where('sale_price', '>', 0);
                            });
                            break;
                        case 'instock':
                            $q->orWhere(function($q2) {
                                $q2->where('stock_quantity', '>', 0)
                                   ->orWhereNull('stock_quantity');
                            });
                            break;
                        case 'outstock':
                            $q->orWhere('stock_quantity', 0);
                            break;
                    }
                }
            });
        }

        // Price filter
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
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        
        switch ($sortBy) {
            case 'name_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'price_asc':
                $query->orderByRaw('COALESCE(sale_price, regular_price) ASC');
                break;
            case 'price_desc':
                $query->orderByRaw('COALESCE(sale_price, regular_price) DESC');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Paginate results
        return $query->paginate(6)->withQueryString();
    }

    private function getProductCounts($category)
    {
        $baseQuery = Product::whereHas('categories', function($q) use ($category) {
            $q->where('product_categories.id', $category->id);
        });

        return [
            'saleProductsCount' => (clone $baseQuery)->whereNotNull('sale_price')
                                         ->where('sale_price', '>', 0)
                                         ->count(),
            'inStockCount' => (clone $baseQuery)->where(function($q) {
                $q->where('stock_quantity', '>', 0)
                  ->orWhereNull('stock_quantity');
            })->count(),
            'outOfStockCount' => (clone $baseQuery)->where('stock_quantity', 0)->count(),
        ];
    }

    private function formatProducts($products)
    {
        // Get user's wishlist product IDs
        $wishlistProductIds = [];
        if (Auth::check()) {
            $wishlistProductIds = Wishlist::where('user_id', Auth::id())
                ->pluck('product_id')
                ->toArray();
        } else {
            // For guest users, check session wishlist
            $sessionWishlist = session()->get('wishlist', []);
            $wishlistProductIds = array_keys($sessionWishlist);
        }

        return collect($products)->map(function($product) use ($wishlistProductIds) {
            // Calculate discount percentage
            $discount = 0;
            if ($product->sale_price && 
                $product->regular_price && 
                $product->sale_price < $product->regular_price) {
                $discount = round((($product->regular_price - $product->sale_price) / $product->regular_price) * 100);
            }

            // Get image URL with fallback
            $imageUrl = $product->featuredImage && $product->featuredImage->url
                ? asset($product->featuredImage->url)
                : asset('assets/frontend/images/placeholder.jpg');

            // Check if product is in wishlist
            $inWishlist = in_array($product->id, $wishlistProductIds);

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
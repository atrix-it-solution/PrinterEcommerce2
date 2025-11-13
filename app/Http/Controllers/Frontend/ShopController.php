<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Wishlist; // Add this import
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        \Log::info('ShopController accessed', ['request' => $request->all()]);

        try {
            // Get categories for filter sidebar
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
                    'success' => true,
                    'products' => $this->formatProducts($products->items()),
                    'pagination' => $this->formatPagination($products),
                    'total_products' => $products->total()
                ]);
            }

            // For normal page loads
            return view('pages.frontend.shop', array_merge(
                compact('products', 'categories'),
                $counts
            ));

        } catch (\Exception $e) {
            \Log::error('ShopController error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            // Return error response for AJAX
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Failed to load products: ' . $e->getMessage()
                ], 500);
            }

            // Return error view for normal requests
            return view('pages.frontend.shop', [
                'products' => Product::paginate(6),
                'categories' => ProductCategory::all(),
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
            $categoryIds = is_array($request->category) ? $request->category : [$request->category];
            $query->whereHas('categories', function($q) use ($categoryIds) {
                $q->whereIn('product_categories.id', $categoryIds);
            });
            \Log::info('Applied category filter', ['categories' => $categoryIds]);
        }

        // === AVAILABILITY FILTER ===
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
            \Log::info('Applied availability filter', ['availability' => $availabilities]);
        }

        // === PRICE FILTER ===
        $minPrice = $request->get('min_price', 0);
        $maxPrice = $request->get('max_price', 10000);
        
        if ($minPrice > 0 || $maxPrice < 10000) {
            $query->where(function($q) use ($minPrice, $maxPrice) {
                // Check regular price
                $q->whereBetween('regular_price', [$minPrice, $maxPrice])
                  // Or check sale price if exists
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
                $query->orderByRaw('COALESCE(sale_price, regular_price) ASC');
                break;
            case 'price_desc':
                $query->orderByRaw('COALESCE(sale_price, regular_price) DESC');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        \Log::info('Final query before pagination', ['sort' => $sortBy]);

        // Paginate results
        return $query->paginate(6)->withQueryString();
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
    if (Auth::check()) {
        $wishlistProductIds = Wishlist::where('user_id', Auth::id())
            ->pluck('product_id')
            ->toArray();
    }

    \Log::info('Wishlist Product IDs:', $wishlistProductIds);

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

        \Log::info("Product {$product->id} processed", [
            'title' => $product->title,
            'in_wishlist' => $inWishlist,
            'wishlist_ids' => $wishlistProductIds
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
            'in_wishlist' => $inWishlist // Make sure this is included
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
<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;
use App\Models\Blog\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        Log::info('Search request received', ['query' => $request->get('q')]);
        
        $query = $request->get('q');
        $limit = $request->get('limit', 5);
        $type = $request->get('type', 'all');
        
        if (!$query || strlen($query) < 2) {
            return response()->json([
                'success' => false,
                'message' => 'Search query must be at least 2 characters',
                'results' => []
            ], 400);
        }

        try {
            Log::info('Attempting search for: ' . $query);
            
            $results = [];
            $productCount = 0;
            $blogCount = 0;
            
            // Search Products
            if ($type === 'all' || $type === 'products') {
                $products = Product::with(['featuredImage'])
                    ->where(function($q) use ($query) {
                        $q->where('title', 'LIKE', "%{$query}%")
                          ->orWhere('description', 'LIKE', "%{$query}%")
                          ->orWhere('sku', 'LIKE', "%{$query}%");
                    })
                    ->limit($type === 'all' ? 3 : $limit)
                    ->get();

                $productCount = $products->count();

                foreach ($products as $product) {
                    $imageUrl = $product->featuredImage && $product->featuredImage->url 
                        ? asset($product->featuredImage->url) 
                        : asset('assets/frontend/images/placeholder.jpg');

                    $results[] = [
                        'type' => 'product',
                        'id' => $product->id,
                        'title' => $product->title,
                        'slug' => $product->slug,
                        'price' => $product->sale_price ?: $product->regular_price,
                        'regular_price' => $product->regular_price,
                        'sale_price' => $product->sale_price,
                        'image' => $imageUrl,
                        'url' => route('product.show', $product->slug),
                        'description' => $product->description ?: '',
                        'created_at' => $product->created_at
                    ];
                }
            }

            // Search Blogs - Handle missing columns safely
            if ($type === 'all' || $type === 'blogs') {
                try {
                    $blogQuery = Blog::with(['featuredImage'])
                        ->where('title', 'LIKE', "%{$query}%");

                    // Only add content/excerpt conditions if columns exist
                    if (Schema::hasColumn('blogs', 'content')) {
                        $blogQuery->orWhere('content', 'LIKE', "%{$query}%");
                    }
                    
                    if (Schema::hasColumn('blogs', 'excerpt')) {
                        $blogQuery->orWhere('excerpt', 'LIKE', "%{$query}%");
                    }

                    $blogs = $blogQuery->limit($type === 'all' ? 2 : $limit)->get();
                    $blogCount = $blogs->count();

                    foreach ($blogs as $blog) {
                        $imageUrl = $blog->featuredImage && $blog->featuredImage->url 
                            ? asset($blog->featuredImage->url) 
                            : asset('assets/frontend/images/placeholder.jpg');

                        $description = '';
                        if (Schema::hasColumn('blogs', 'excerpt') && $blog->excerpt) {
                            $description = $blog->excerpt;
                        } elseif (Schema::hasColumn('blogs', 'content') && $blog->content) {
                            $description = substr(strip_tags($blog->content), 0, 150) . '...';
                        }

                        $results[] = [
                            'type' => 'blog',
                            'id' => $blog->id,
                            'title' => $blog->title,
                            'slug' => $blog->slug,
                            'image' => $imageUrl,
                            'url' => route('frontend.blog.single', $blog->slug),
                            'description' => $description,
                            'created_at' => $blog->created_at,
                            'author' => $blog->author ?? 'Admin'
                        ];
                    }
                } catch (\Exception $e) {
                    Log::error('Blog search error: ' . $e->getMessage());
                    // Continue with products even if blog search fails
                }
            }

            Log::info('Found ' . count($results) . ' results');

            return response()->json([
                'success' => true,
                'results' => $results,
                'search_term' => $query,
                'count' => count($results),
                'product_count' => $productCount,
                'blog_count' => $blogCount
            ]);

        } catch (\Exception $e) {
            Log::error('Search error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Error performing search: ' . $e->getMessage(),
                'results' => []
            ], 500);
        }
    }

    public function searchResults(Request $request)
{
    $query = $request->get('q');
    $type = $request->get('type', 'all');
    $page = $request->get('page', 1);
    $perPage = 6;
    
    if (!$query) {
        return redirect()->back()->with('error', 'Please enter a search term');
    }

    $allResults = collect([]);
    $products = collect([]);
    $blogs = collect([]);

    // For "all" type - combine products and blogs with manual pagination
    if ($type === 'all') {
        // Get products with search relevance scoring
        $products = Product::with(['featuredImage'])
            ->where(function($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('sku', 'LIKE', "%{$query}%");
            })
            ->get()
            ->map(function($product) use ($query) {
                // Calculate relevance score
                $relevance = 0;
                if (stripos($product->title, $query) !== false) {
                    $relevance += 10; // Highest priority for title matches
                }
                if (stripos($product->description, $query) !== false) {
                    $relevance += 5; // Medium priority for description matches
                }
                if (stripos($product->sku, $query) !== false) {
                    $relevance += 8; // High priority for SKU matches
                }
                
                $imageUrl = $product->featuredImage && $product->featuredImage->url 
                    ? asset($product->featuredImage->url) 
                    : asset('assets/frontend/images/placeholder.jpg');

                return [
                    'type' => 'product',
                    'id' => $product->id,
                    'title' => $product->title,
                    'slug' => $product->slug,
                    'price' => $product->sale_price ?: $product->regular_price,
                    'regular_price' => $product->regular_price,
                    'sale_price' => $product->sale_price,
                    'image' => $imageUrl,
                    'url' => route('product.show', $product->slug),
                    'description' => $product->description ?: '',
                    'created_at' => $product->created_at,
                    'relevance_score' => $relevance,
                    'sort_date' => $product->created_at
                ];
            });

        // Get blogs with search relevance scoring
        try {
            $blogQuery = Blog::with(['featuredImage'])
                ->where('title', 'LIKE', "%{$query}%");

            if (Schema::hasColumn('blogs', 'content')) {
                $blogQuery->orWhere('content', 'LIKE', "%{$query}%");
            }
            
            if (Schema::hasColumn('blogs', 'excerpt')) {
                $blogQuery->orWhere('excerpt', 'LIKE', "%{$query}%");
            }

            $blogs = $blogQuery->get()
                ->map(function($blog) use ($query) {
                    // Calculate relevance score
                    $relevance = 0;
                    if (stripos($blog->title, $query) !== false) {
                        $relevance += 10; // Highest priority for title matches
                    }
                    if (Schema::hasColumn('blogs', 'content') && stripos($blog->content, $query) !== false) {
                        $relevance += 5; // Medium priority for content matches
                    }
                    if (Schema::hasColumn('blogs', 'excerpt') && stripos($blog->excerpt, $query) !== false) {
                        $relevance += 7; // High priority for excerpt matches
                    }
                    
                    $imageUrl = $blog->featuredImage && $blog->featuredImage->url 
                        ? asset($blog->featuredImage->url) 
                        : asset('assets/frontend/images/placeholder.jpg');

                    $description = '';
                    if (Schema::hasColumn('blogs', 'excerpt') && $blog->excerpt) {
                        $description = $blog->excerpt;
                    } elseif (Schema::hasColumn('blogs', 'content') && $blog->content) {
                        $description = substr(strip_tags($blog->content), 0, 150) . '...';
                    }

                    return [
                        'type' => 'blog',
                        'id' => $blog->id,
                        'title' => $blog->title,
                        'slug' => $blog->slug,
                        'image' => $imageUrl,
                        'url' => route('frontend.blog.single', $blog->slug),
                        'description' => $description,
                        'created_at' => $blog->created_at,
                        'author' => $blog->author ?? 'Admin',
                        'relevance_score' => $relevance,
                        'sort_date' => $blog->created_at
                    ];
                });

        } catch (\Exception $e) {
            Log::error('Blog search results error: ' . $e->getMessage());
            $blogs = collect([]);
        }

        // Combine results
        $allResults = $products->concat($blogs);

        // Sort by multiple criteria for better user experience
        $allResults = $allResults->sortByDesc(function($item) {
            // Primary: Relevance score (most relevant first)
            // Secondary: Creation date (newest first)
            // Tertiary: Type (products before blogs)
            $typePriority = $item['type'] === 'product' ? 1 : 0;
            return [
                $item['relevance_score'], // Highest relevance first
                $typePriority,            // Products before blogs
                $item['sort_date']        // Newest first
            ];
        });

        // Manual pagination for combined results
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $allResults->slice(($currentPage - 1) * $perPage, $perPage)->values();
        
        $paginatedResults = new LengthAwarePaginator(
            $currentItems,
            $allResults->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath(), 'query' => ['q' => $query, 'type' => $type]]
        );

        return view('pages.frontend.search-results', [
            'allResults' => $paginatedResults,
            'products' => collect([]),
            'blogs' => collect([]),
            'query' => $query,
            'type' => $type
        ]);

    } else {
        // ... rest of your code for individual types
        // For individual types (products or blogs) - use normal pagination
        if ($type === 'products') {
            $products = Product::with(['featuredImage'])
                ->where(function($q) use ($query) {
                    $q->where('title', 'LIKE', "%{$query}%")
                      ->orWhere('description', 'LIKE', "%{$query}%")
                      ->orWhere('sku', 'LIKE', "%{$query}%");
                })
                ->orderByRaw("
                    CASE 
                        WHEN title LIKE ? THEN 1 
                        WHEN sku LIKE ? THEN 2
                        WHEN description LIKE ? THEN 3
                        ELSE 4
                    END
                ", ["%{$query}%", "%{$query}%", "%{$query}%"])
                ->orderBy('created_at', 'desc')
                ->paginate($perPage, ['*'], 'page')
                ->appends(['q' => $query, 'type' => $type]);
        }

        if ($type === 'blogs') {
            try {
                $blogQuery = Blog::with(['featuredImage'])
                    ->where('title', 'LIKE', "%{$query}%");

                if (Schema::hasColumn('blogs', 'content')) {
                    $blogQuery->orWhere('content', 'LIKE', "%{$query}%");
                }
                
                if (Schema::hasColumn('blogs', 'excerpt')) {
                    $blogQuery->orWhere('excerpt', 'LIKE', "%{$query}%");
                }

                $blogs = $blogQuery->orderByRaw("
                        CASE 
                            WHEN title LIKE ? THEN 1 
                            WHEN excerpt LIKE ? THEN 2
                            WHEN content LIKE ? THEN 3
                            ELSE 4
                        END
                    ", ["%{$query}%", "%{$query}%", "%{$query}%"])
                    ->orderBy('created_at', 'desc')
                    ->paginate($perPage, ['*'], 'page')
                    ->appends(['q' => $query, 'type' => $type]);
            } catch (\Exception $e) {
                Log::error('Blog search results error: ' . $e->getMessage());
                $blogs = collect([]);
            }
        }

        return view('pages.frontend.search-results', compact('products', 'blogs', 'query', 'type'));
    }
}
}
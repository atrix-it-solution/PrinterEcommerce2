<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Wishlist; // You'll need to create this model
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id'
            ]);

            // Check if user is authenticated
            if (Auth::check()) {
                return $this->addToDatabaseWishlist($request->product_id);
            } else {
                return $this->addToSessionWishlist($request->product_id);
            }

        } catch (\Exception $e) {
            Log::error('Add to wishlist error:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function toggleWishlist(Request $request)
    {
        try {
            Log::info('Toggle wishlist request:', $request->all());
            
            $request->validate([
                'product_id' => 'required|exists:products,id'
            ]);

            // Redirect to login if not authenticated
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'redirect' => true,
                    'message' => 'Please login to add items to wishlist',
                    'login_url' => route('login.register')
                ], 401);
            }

            Log::info('User authenticated, checking wishlist for product: ' . $request->product_id);

            $wishlist = Wishlist::where('user_id', Auth::id())
                              ->where('product_id', $request->product_id)
                              ->first();

            if ($wishlist) {
                // Remove from wishlist
                $wishlist->delete();
                $message = 'Product removed from wishlist!';
                $isInWishlist = false;
                Log::info('Product removed from wishlist');
            } else {
                // Add to wishlist
                Wishlist::create([
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id
                ]);
                $message = 'Product added to wishlist successfully!';
                $isInWishlist = true;
                Log::info('Product added to wishlist');
            }

            $wishlistCount = $this->getWishlistCount();

            return response()->json([
                'success' => true,
                'message' => $message,
                'wishlist_count' => $wishlistCount,
                'is_in_wishlist' => $isInWishlist
            ]);

        } catch (\Exception $e) {
            Log::error('Toggle wishlist error:', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getWishlistData()
    {
        try {
            Log::info('Getting wishlist count for user: ' . (Auth::check() ? Auth::id() : 'guest'));
            
            $wishlistCount = $this->getWishlistCount();
            
            return response()->json([
                'wishlist_count' => $wishlistCount
            ]);
        } catch (\Exception $e) {
            Log::error('Get wishlist data error:', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            return response()->json([
                'wishlist_count' => 0
            ]);
        }
    }

    public function getWishlistCount()
    {
        try {
            if (Auth::check()) {
                $count = Wishlist::where('user_id', Auth::id())->count();
                Log::info('Database wishlist count: ' . $count);
                return $count;
            } else {
                $wishlist = session()->get('wishlist', []);
                $count = count($wishlist);
                Log::info('Session wishlist count: ' . $count);
                return $count;
            }
        } catch (\Exception $e) {
            Log::error('Get wishlist count error: ' . $e->getMessage());
            return 0;
        }
    }

    // Helper methods
    private function addToDatabaseWishlist($productId)
    {
        $existingWishlist = Wishlist::where('user_id', Auth::id())
                                  ->where('product_id', $productId)
                                  ->first();

        if ($existingWishlist) {
            return response()->json([
                'success' => false,
                'message' => 'Product is already in your wishlist!'
            ], 422);
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $productId
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product added to wishlist successfully!',
            'wishlist_count' => $this->getWishlistCount()
        ]);
    }

    private function addToSessionWishlist($productId)
    {
        $product = Product::with('featuredImage')->findOrFail($productId);
        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$productId])) {
            return response()->json([
                'success' => false,
                'message' => 'Product is already in your wishlist!'
            ], 422);
        }

        $imageUrl = asset('assets/frontend/images/placeholder.jpg');
        if ($product->featuredImage && $product->featuredImage->url) {
            $imageUrl = asset($product->featuredImage->url);
        }

        $wishlist[$productId] = [
            'product_id' => $product->id,
            'title' => $product->title,
            'slug' => $product->slug,
            'price' => $product->sale_price ?: $product->regular_price,
            'regular_price' => $product->regular_price,
            'sale_price' => $product->sale_price,
            'image' => $imageUrl,
            'added_at' => now()->toDateTimeString()
        ];

        session()->put('wishlist', $wishlist);

        return response()->json([
            'success' => true,
            'message' => 'Product added to wishlist successfully!',
            'wishlist_count' => $this->getWishlistCount()
        ]);
    }

    private function getDatabaseWishlistItems()
    {
        $wishlistItems = [];
        $userWishlist = Wishlist::with('product.featuredImage')
                              ->where('user_id', Auth::id())
                              ->get();

        foreach ($userWishlist as $item) {
            $product = $item->product;
            $imageUrl = asset('assets/frontend/images/placeholder.jpg');
            
            if ($product->featuredImage && $product->featuredImage->url) {
                $imageUrl = asset($product->featuredImage->url);
            }

            $wishlistItems[$product->id] = [
                'product_id' => $product->id,
                'title' => $product->title,
                'slug' => $product->slug,
                'price' => $product->sale_price ?: $product->regular_price,
                'regular_price' => $product->regular_price,
                'sale_price' => $product->sale_price,
                'image' => $imageUrl,
                'added_at' => $item->created_at->toDateTimeString()
            ];
        }

        return $wishlistItems;
    }

    private function getSessionWishlistItems()
    {
        return session()->get('wishlist', []);
    }

    // Sync session wishlist to database after login
    public function syncWishlist()
    {
        if (Auth::check()) {
            $sessionWishlist = session()->get('wishlist', []);
            
            foreach ($sessionWishlist as $productId => $item) {
                // Check if already exists in database
                $exists = Wishlist::where('user_id', Auth::id())
                                ->where('product_id', $productId)
                                ->exists();

                if (!$exists) {
                    Wishlist::create([
                        'user_id' => Auth::id(),
                        'product_id' => $productId
                    ]);
                }
            }

            // Clear session wishlist after syncing
            session()->forget('wishlist');

            return response()->json([
                'success' => true,
                'message' => 'Wishlist synced successfully',
                'wishlist_count' => $this->getWishlistCount()
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'User not authenticated'
        ], 401);
    }


    public function checkWishlist(Request $request)
    {
        try {
            Log::info('Check wishlist request received:', $request->all());
            
            $request->validate([
                'product_id' => 'required|exists:products,id'
            ]);

            $isInWishlist = false;

            if (Auth::check()) {
                Log::info('User authenticated, checking database wishlist for user: ' . Auth::id());
                
                // Check database wishlist
                $isInWishlist = Wishlist::where('user_id', Auth::id())
                                      ->where('product_id', $request->product_id)
                                      ->exists();
                
                Log::info('Database check result: ' . ($isInWishlist ? 'true' : 'false'));
            } else {
                Log::info('User not authenticated, checking session wishlist');
                
                // Check session wishlist
                $wishlist = session()->get('wishlist', []);
                $isInWishlist = isset($wishlist[$request->product_id]);
                
                Log::info('Session check result: ' . ($isInWishlist ? 'true' : 'false'));
                Log::info('Session wishlist contents:', $wishlist);
            }

            return response()->json([
                'success' => true,
                'is_in_wishlist' => $isInWishlist
            ]);

        } catch (\Exception $e) {
            Log::error('Check wishlist error:', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'is_in_wishlist' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function viewWishlist()
    {
        try {
            if (Auth::check()) {
                // Get from database
                $wishlistItems = $this->getDatabaseWishlistItems();
            } else {
                // Get from session
                $wishlistItems = $this->getSessionWishlistItems();
            }

            Log::info('Viewing wishlist with ' . count($wishlistItems) . ' items');

            return view('pages.frontend.wishlist', compact('wishlistItems'));

        } catch (\Exception $e) {
            Log::error('Error viewing wishlist: ' . $e->getMessage());
            
            // Fallback to empty wishlist
            $wishlistItems = [];
            return view('pages.frontend.wishlist', compact('wishlistItems'));
        }
    }

    public function removeFromWishlist(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id'
            ]);

            if (Auth::check()) {
                // Remove from database
                Wishlist::where('user_id', Auth::id())
                    ->where('product_id', $request->product_id)
                    ->delete();
                
                Log::info('Product removed from database wishlist: ' . $request->product_id);
            } else {
                // Remove from session
                $wishlist = session()->get('wishlist', []);
                
                if (isset($wishlist[$request->product_id])) {
                    unset($wishlist[$request->product_id]);
                    session()->put('wishlist', $wishlist);
                    Log::info('Product removed from session wishlist: ' . $request->product_id);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Product removed from wishlist!',
                'wishlist_count' => $this->getWishlistCount()
            ]);

        } catch (\Exception $e) {
            Log::error('Remove from wishlist error:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id'
            ]);

            $product = Product::with('featuredImage')->findOrFail($request->product_id);
            
            $wishlist = session()->get('wishlist', []);

            // Check if product already in wishlist
            if (isset($wishlist[$request->product_id])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product is already in your wishlist!'
                ], 422);
            }

            // Get image URL safely - FIXED
            $imageUrl = asset('assets/frontend/images/placeholder.jpg'); // Use correct default image path
            if ($product->featuredImage && $product->featuredImage->url) {
                $imageUrl = asset($product->featuredImage->url);
            }

            // Add product to wishlist
            $wishlist[$request->product_id] = [
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

        } catch (\Exception $e) {
            \Log::error('Add to wishlist error:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function removeFromWishlist(Request $request)
    {
        try {
            $wishlist = session()->get('wishlist', []);
            
            if (isset($wishlist[$request->product_id])) {
                unset($wishlist[$request->product_id]);
                session()->put('wishlist', $wishlist);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Product removed from wishlist!',
                    'wishlist_count' => $this->getWishlistCount()
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Product not found in wishlist.'
            ], 404);

        } catch (\Exception $e) {
            \Log::error('Remove from wishlist error:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function viewWishlist()
    {
        $wishlistItems = session()->get('wishlist', []);
        return view('pages.frontend.wishlist', compact('wishlistItems'));
    }

    public function getWishlistCount()
    {
        $wishlist = session()->get('wishlist', []);
        return count($wishlist);
    }

    public function getWishlistData()
    {
        try {
            return response()->json([
                'wishlist_count' => $this->getWishlistCount()
            ]);
        } catch (\Exception $e) {
            \Log::error('Get wishlist data error:', ['error' => $e->getMessage()]);
            return response()->json([
                'wishlist_count' => 0
            ]);
        }
    }

    public function toggleWishlist(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id'
            ]);

            $wishlist = session()->get('wishlist', []);

            // Check if product already in wishlist
            if (isset($wishlist[$request->product_id])) {
                // Remove from wishlist
                unset($wishlist[$request->product_id]);
                $message = 'Product removed from wishlist!';
                $isInWishlist = false;
            } else {
                // Add to wishlist
                $product = Product::with('featuredImage')->findOrFail($request->product_id);
                
                // Get image URL safely - FIXED
                $imageUrl = asset('assets/frontend/images/placeholder.jpg');
                if ($product->featuredImage && $product->featuredImage->url) {
                    $imageUrl = asset($product->featuredImage->url);
                }

                $wishlist[$request->product_id] = [
                    'product_id' => $product->id,
                    'title' => $product->title,
                    'slug' => $product->slug,
                    'price' => $product->sale_price ?: $product->regular_price,
                    'regular_price' => $product->regular_price,
                    'sale_price' => $product->sale_price,
                    'image' => $imageUrl,
                    'added_at' => now()->toDateTimeString()
                ];
                $message = 'Product added to wishlist successfully!';
                $isInWishlist = true;
            }

            session()->put('wishlist', $wishlist);

            return response()->json([
                'success' => true,
                'message' => $message,
                'wishlist_count' => $this->getWishlistCount(),
                'is_in_wishlist' => $isInWishlist
            ]);

        } catch (\Exception $e) {
            \Log::error('Toggle wishlist error:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }



    public function checkWishlist(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id'
            ]);

            $wishlist = session()->get('wishlist', []);
            $isInWishlist = isset($wishlist[$request->product_id]);

            return response()->json([
                'success' => true,
                'is_in_wishlist' => $isInWishlist
            ]);

        } catch (\Exception $e) {
            \Log::error('Check wishlist error:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'is_in_wishlist' => false
            ]);
        }
    }
}
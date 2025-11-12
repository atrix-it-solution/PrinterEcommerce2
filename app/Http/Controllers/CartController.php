<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
      public function addToCart(Request $request)
    {
        try {
            \Log::info('Add to cart request:', $request->all());

            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1'
            ]);

            $product = Product::with('featuredImage')->findOrFail($request->product_id);
            
            \Log::info('Product found:', ['product' => $product->id, 'stock' => $product->stock_quantity]);

            // Check stock availability
            if (!is_null($product->stock_quantity) && $product->stock_quantity < $request->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient stock. Only ' . $product->stock_quantity . ' items available.'
                ], 422);
            }

            $cart = session()->get('cart', []);

            // If product already in cart, update quantity
            if (isset($cart[$request->product_id])) {
                $newQuantity = $cart[$request->product_id]['quantity'] + $request->quantity;
                
                // Check stock limit
                if (!is_null($product->stock_quantity) && $newQuantity > $product->stock_quantity) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Cannot add more. Maximum available quantity is ' . $product->stock_quantity . '. You already have ' . $cart[$request->product_id]['quantity'] . ' in cart.'
                    ], 422);
                }
                
                $cart[$request->product_id]['quantity'] = $newQuantity;
            } else {
                // Get image URL safely
                $imageUrl = asset('assets/images/product_img1.jpg'); // Default image
                if ($product->featuredImage && $product->featuredImage->file_path) {
                    $imageUrl = Storage::url($product->featuredImage->file_path);
                }

                // Add new product to cart
                $cart[$request->product_id] = [
                    'product_id' => $product->id,
                    'title' => $product->title,
                    'slug' => $product->slug,
                    'price' => $product->sale_price ?: $product->regular_price,
                    'regular_price' => $product->regular_price,
                    'sale_price' => $product->sale_price,
                    'quantity' => $request->quantity,
                    'image' => $imageUrl,
                    'stock_quantity' => $product->stock_quantity
                ];
            }

            session()->put('cart', $cart);

            \Log::info('Cart updated:', ['cart_count' => $this->getCartCount()]);

            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'cart_count' => $this->getCartCount(),
                'cart_total' => $this->getCartTotal()
            ]);

        } catch (\Exception $e) {
            \Log::error('Add to cart error:', [
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

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        
        // Calculate cart totals
        $subtotal = 0;
        $totalSavings = 0;
        $total = 0;
        
        foreach ($cart as $item) {
            $itemTotal = $item['price'] * $item['quantity'];
            $subtotal += $itemTotal;
            
            // Calculate savings if there's a sale price
            if ($item['sale_price'] && $item['sale_price'] < $item['regular_price']) {
                $savings = ($item['regular_price'] - $item['sale_price']) * $item['quantity'];
                $totalSavings += $savings;
            }
        }
        
        $total = $subtotal;
        
        return view('pages.frontend.cart', compact('cart', 'subtotal', 'totalSavings', 'total'));
    }

    public function updateCart(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1'
            ]);

            $cart = session()->get('cart', []);
            
            if (isset($cart[$request->product_id])) {
                $product = Product::find($request->product_id);
                
                // Check stock availability
                if (!is_null($product->stock_quantity) && $request->quantity > $product->stock_quantity) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Only ' . $product->stock_quantity . ' items available.'
                    ], 422);
                }
                
                $cart[$request->product_id]['quantity'] = $request->quantity;
                session()->put('cart', $cart);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Cart updated successfully!',
                    'cart_count' => $this->getCartCount(),
                    'cart_total' => $this->getCartTotal(),
                    'item_total' => $cart[$request->product_id]['price'] * $request->quantity
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Product not found in cart.'
            ], 404);

        } catch (\Exception $e) {
            \Log::error('Update cart error:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function removeFromCart(Request $request)
    {
        try {
            $cart = session()->get('cart', []);
            
            if (isset($cart[$request->product_id])) {
                unset($cart[$request->product_id]);
                session()->put('cart', $cart);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Product removed from cart!',
                    'cart_count' => $this->getCartCount(),
                    'cart_total' => $this->getCartTotal()
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Product not found in cart.'
            ], 404);

        } catch (\Exception $e) {
            \Log::error('Remove from cart error:', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getCartCount()
    {
        $cart = session()->get('cart', []);
        return array_sum(array_column($cart, 'quantity'));
    }

    public function getCartTotal()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return number_format($total, 2);
    }

    public function getCartData()
    {
        try {
            return response()->json([
                'cart_count' => $this->getCartCount(),
                'cart_total' => $this->getCartTotal()
            ]);
        } catch (\Exception $e) {
            \Log::error('Get cart data error:', ['error' => $e->getMessage()]);
            return response()->json([
                'cart_count' => 0,
                'cart_total' => '0.00'
            ]);
        }
    }
}

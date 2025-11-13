<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WishlistController; // Add this import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [], [
            'email' => 'login_email',
            'password' => 'login_password'
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Sync session wishlist to database after successful login
            $this->syncWishlistAfterLogin();

            if (Auth::user()->role === 'customer') {
                $this->revokeUserTokens(Auth::user());
                return redirect()->intended('/');
            }

            // Redirect based on user role
            if (Auth::user()->isAdmin()) {
                return redirect()->intended('/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));
    }

    /**
     * Sync session wishlist to database after login
     */
    private function syncWishlistAfterLogin()
    {
        try {
            // Check if there are any items in session wishlist
            $sessionWishlist = session()->get('wishlist', []);
            
            if (!empty($sessionWishlist) && Auth::check()) {
                $wishlistController = new WishlistController();
                
                // Use reflection to call the protected method, or make it public
                // Option 1: If you make syncWishlist public in WishlistController
                $wishlistController->syncWishlist();
                
                // Option 2: Alternative direct implementation
                // $this->syncWishlistToDatabase($sessionWishlist);
            }
        } catch (\Exception $e) {
            \Log::error('Wishlist sync error during login: ' . $e->getMessage());
            // Don't break the login process if wishlist sync fails
        }
    }

    /**
     * Alternative direct implementation of wishlist sync
     */
    private function syncWishlistToDatabase($sessionWishlist)
    {
        foreach ($sessionWishlist as $productId => $item) {
            // Check if already exists in database
            $exists = \App\Models\Wishlist::where('user_id', Auth::id())
                        ->where('product_id', $productId)
                        ->exists();

            if (!$exists) {
                \App\Models\Wishlist::create([
                    'user_id' => Auth::id(),
                    'product_id' => $productId
                ]);
            }
        }

        // Clear session wishlist after syncing
        session()->forget('wishlist');
    }

    public function logout(Request $request)
    {
        // Safely revoke Sanctum tokens if any
        if (Auth::check()) {
            $this->revokeUserTokens(Auth::user());
        }

        // Traditional Laravel logout
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Clear session tokens
        session()->forget('auth_token');
        session()->forget('user');

        return redirect('/')->with('success', 'Logged out successfully!');
    }

    /**
     * Safely revoke user tokens
     */
    private function revokeUserTokens($user)
    {
        try {
            // Check if user has tokens method (Sanctum trait)
            if (method_exists($user, 'tokens')) {
                $user->tokens()->delete();
            }
            
            // Also check for currentAccessToken method
            if (method_exists($user, 'currentAccessToken') && $user->currentAccessToken()) {
                $user->currentAccessToken()->delete();
            }
        } catch (\Exception $e) {
            // Log error but don't break the logout process
            \Log::error('Error revoking tokens: ' . $e->getMessage());
        }
    }
}
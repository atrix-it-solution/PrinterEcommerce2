<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
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

            // Clear any existing Sanctum tokens for frontend users
            if (Auth::user()->role === 'customer') {
                Auth::user()->tokens()->delete();
            }

            // Redirect based on user role
            if (Auth::user()->isAdmin()) {
                return redirect()->intended('/dashboard');
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));
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
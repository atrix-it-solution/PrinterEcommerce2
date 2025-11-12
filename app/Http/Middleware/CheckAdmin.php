<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Sanctum\PersonalAccessToken;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated via session OR token
        if (!Auth::check() && !$this->checkTokenAuth($request)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated.',
                    'redirect' => '/login-register'
                ], 401);
            }
            return redirect('/login-register')->with('error', 'Please login to access this page.');
        }

        // Get the user (either from session or token)
        $user = Auth::user();
        if (!$user && $request->user()) {
            $user = $request->user();
        }

        // Additional security: Check if this is a logout scenario
        if ($this->isLogoutScenario($request)) {
            $this->forceLogout();
            return redirect('/login-register')->with('error', 'Your session has been terminated.');
        }

        // Check if user has admin role
        if (!$user || $user->role !== 'admin') {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Access denied. Admin privileges required.',
                    'redirect' => '/'
                ], 403);
            }
            return redirect('/')->with('error', 'Access denied. Admin privileges required.');
        }

        // Double-check token validity for API requests
        if ($request->expectsJson() && !$this->validateCurrentToken($user)) {
            $this->forceLogout();
            return response()->json([
                'success' => false,
                'message' => 'Token invalid or expired.',
                'redirect' => '/login-register'
            ], 401);
        }

        return $next($request);
    }

    /**
     * Check if user is authenticated via token
     */
    private function checkTokenAuth(Request $request): bool
    {
        // Check for Bearer token in Authorization header
        $token = $request->bearerToken();
        
        if (!$token) {
            // Also check for token in query string or session (for web routes)
            $token = $request->get('token') ?: $request->cookie('token') ?: session('auth_token');
        }

        if (!$token) {
            return false;
        }

        // Find the token in database
        $accessToken = PersonalAccessToken::findToken($token);
        
        if (!$accessToken) {
            return false;
        }

        // Check if token is expired (5 minutes)
        if ($accessToken->created_at->lessThan(now()->subHours(24))) {
            $accessToken->delete(); // Delete expired token
            return false;
        }

        // Get the user and log them in for the request
        $user = $accessToken->tokenable;
        if ($user) {
            Auth::login($user);
            return true;
        }

        return false;
    }

    /**
     * Check if this is a logout scenario (no localStorage token but session exists)
     */
    private function isLogoutScenario(Request $request): bool
    {
        // For API requests, check Authorization header
        if ($request->expectsJson()) {
            $token = $request->bearerToken();
            return !$token || !PersonalAccessToken::findToken($token);
        }

        // For web requests, check if session exists but no token in request
        if (Auth::check() && !$request->has('token') && !session('auth_token')) {
            return true;
        }

        return false;
    }

    /**
     * Validate the current user's token
     */
    private function validateCurrentToken($user): bool
    {
        if (!$user->currentAccessToken()) {
            return false;
        }

        $token = $user->currentAccessToken();
        return !$token->created_at->lessThan(now()->subHours(24));
    }

    /**
     * Force logout user
     */
    private function forceLogout(): void
    {
        if (Auth::check()) {
            // Revoke Sanctum token if exists
            if (Auth::user()->currentAccessToken()) {
                Auth::user()->currentAccessToken()->delete();
            }
            
            // Traditional Laravel logout
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
            
            // Clear token from session
            session()->forget('auth_token');
        }
    }
}
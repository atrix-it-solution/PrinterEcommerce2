<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Sanctum\PersonalAccessToken;

class CheckTokenExpiration
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect('/login-register')->with('error', 'Please login to access this page.');
        }

        $user = Auth::user();

        // Check if user has a valid token
        $token = session('auth_token');
        if ($token) {
            $accessToken = PersonalAccessToken::findToken($token);
            
            // If token is expired or invalid, logout user
            if (!$accessToken || $accessToken->created_at->lessThan(now()->subHours(24))) {
                // Delete expired token
                $accessToken?->delete();
                
                // Logout user
                Auth::logout();
                // Logout user
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                session()->flush();
                
                return redirect('/login-register')->with('error', 'Your session has expired. Please login again.');
            }
        }

        return $next($request);
    }
}
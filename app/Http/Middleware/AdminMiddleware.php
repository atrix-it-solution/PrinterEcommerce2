<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated.',
                    'redirect' => '/login-register'
                ], 401);
            }
            return redirect('/login-register')->with('error', 'Please login to access this page.');
        }

        // Check if user has admin role
        if (Auth::user()->role !== 'admin') {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Access denied. Admin privileges required.',
                    'redirect' => '/'
                ], 403);
            }
            return redirect('/')->with('error', 'Access denied. Admin privileges required.');
        }

        return $next($request);
    }
}
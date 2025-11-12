<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MyAccountController extends Controller
{

    /**
     * Show the user's account dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        
        return view('pages.frontend.my-account', [
            'user' => $user
        ]);
    }

    /**
     * Show the user's orders.
     */
    public function orders()
    {
        $user = Auth::user();
        
        return view('pages.frontend.orders', [
            'user' => $user
        ]);
    }

    /**
     * Show the user's wishlist.
     */
    public function wishlist()
    {
        $user = Auth::user();
        
        return view('pages.frontend.wishlist', [
            'user' => $user
        ]);
    }
}
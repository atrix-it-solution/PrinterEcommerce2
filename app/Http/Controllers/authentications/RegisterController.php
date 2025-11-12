<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [], [
            'name' => 'register_name',
            'email' => 'register_email',
            'phone' => 'register_phone',
            'password' => 'register_password'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator, 'register')->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'customer', 
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Registration successful! Welcome to our store.');
    }
}
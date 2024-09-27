<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\Users\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    // Register a new user.
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token', ['server:update'])->plainTextToken;

        return response()->json(['message' => Lang::get('user.register'),
            'access_token' => $token,
            'token_type' => 'Bearer',]);
    }

    // Login an existing user.
    public function login(Request $request)
    {   
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.'
            ],401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token', ['server:update'])->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    
    // Logout the authenticated user.
    public function logout(Request $request)
    {
        if ($request->user() && $request->user()->currentAccessToken()) {
            $request->user()->currentAccessToken()->delete();
        }

        return response()->json(['message' => Lang::get('user.logout')]);
    }
    
    // Get the authenticated user.
    public function user(Request $request)
{
    $user = $request->user();
    if (!$user) {
        return response()->json(['message' => 'user.unauthorized']);
    }

    return response()->json($user);
}

}

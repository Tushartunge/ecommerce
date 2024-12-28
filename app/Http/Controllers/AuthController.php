<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Register User or Admin
    // public function register(Request $request)
    // {
    //     // Validate incoming request
    //     $validated = $request->validate([
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'mobile' => 'required|string|unique:users|max:15', // Ensure mobile number is unique
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|string|min:6|confirmed',  // Ensure password confirmation
    //         'role' => 'required|in:user,admin',
    //     ]);
    
    //     // Create the user with validated data
    //     $user = User::create([
    //         'first_name' => $validated['first_name'],
    //         'last_name' => $validated['last_name'],
    //         'mobile' => $validated['mobile'],
    //         'email' => $validated['email'],
    //         'password' => Hash::make($validated['password']),
    //         'role' => $validated['role'],
    //     ]);
    


    //     return response()->json(['message' => 'User registered successfully']);
    // }

    // Login User or Admin
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token', [$user->role])->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'role' => $user->role,
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}


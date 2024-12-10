<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;  // User Model ko import karna
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Login Method
    public function login(Request $request)
    {
        // Request Validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Check credentials
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Login successful, generate token
            $user = Auth::user();
            $token = $user->createToken('YourAppName')->plainTextToken;

            // Return token in the response
            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
            ]);
        }

        // Unauthorized response
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}

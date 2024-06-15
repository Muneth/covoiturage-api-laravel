<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Register a new user
    public function register(Request $request)
    {
        // Validate the request
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        // Create a new user
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        // Generate a token for the user
        $token = $user->createToken('myapptoken')->plainTextToken;

        // Prepare the response
        $response = [
            'user' => $user,
            'token' => $token
        ];

        // Return the response
        return response($response, 201);
    }

    // Login a user
    public function login(Request $request)
    {
        // Validate the request
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Find the user
        $user = User::where('email', $fields['email'])->first();

        // Check the password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad credentials'
            ], 401);
        }

        // Generate a token for the user
        $token = $user->createToken('myapptoken')->plainTextToken;

        // Prepare the response
        $response = [
            'user' => $user,
            'token' => $token
        ];

        // Return the response
        return response($response, 201);
    }

    // Logout a user
    public function logout(Request $request)
    {
        // Revoke the token
        auth()->user()->tokens()->delete();

        // Prepare the response
        $response = [
            'message' => 'Logged out'
        ];

        // Return the response
        return response($response, 200);
    }
}

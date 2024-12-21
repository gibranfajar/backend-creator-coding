<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{

    public function getData()
    {
        $user = User::all();
        return response()->json([
            'data' => $user
        ], 200);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return response()->json(['message' => 'create success'], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            return response()->json(['message' => 'login success', 'user' => [
                'name' => auth()->user()->name,
                'token' => auth()->user()->createToken('authToken')->plainTextToken
            ]], 200);
        }

        return response()->json(['message' => 'login failed'], 401);
    }
}

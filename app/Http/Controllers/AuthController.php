<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request){
        $validatedData = $request->validated();

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'])
        ]);

        $token = $user->createToken('API token of ' . $user->name)->plainTextToken;

        return response()->json([
            'user' => ["name" => $user->name, "isAdmin" => $user->is_admin],
            'token' => $token,
        ], 201);
    }

    public function login(LoginUserRequest $request){
        $validatedData = $request->validated();

        $credentials = [
            'email' => $validatedData['email'],
            'password' => $validatedData['password']
        ];

        if(!Auth::attempt($credentials)){
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('Auth token of ' . $user->name)->plainTextToken;

        return response()->json([
            'user' => ["name" => $user->name, "isAdmin" => $user->is_admin],
            'token' => $token
        ], 200);
    }

    public function logout(){
        Auth::user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}

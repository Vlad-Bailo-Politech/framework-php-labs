<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // Авторизація (логін)
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json(['token' => $token]);
    }

    // Отримати поточного користувача
    public function me()
    {
        return response()->json(Auth::user());
    }

    // Вийти (деактивувати токен)
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    // Оновити токен
    public function refresh()
    {
        return response()->json([
            'token' => Auth::refresh()
        ]);
    }
}

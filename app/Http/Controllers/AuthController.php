<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->token = $user->createToken('auth_token')->accessToken;

        return response([
            'message' => 'Successfully registered',
            'token' => $user->token,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
            ]
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->input('email'))
            ->orWhere('phone', $request->input('phone'))
            ->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return response([
                'message' => 'Provided credentials are incorrect'
            ], 400);
        }

        $user->token = $user->createToken('auth_token')->accessToken;

        return response([
            'message' => 'Successfully logged in',
            'token' => $user->token,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
            ]
        ]);
    }
}

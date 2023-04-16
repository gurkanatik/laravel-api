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
        $validated = $request->validated();

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->password = Hash::make($validated['password']);

        if ($user->save()) {
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

        return response([
            'message' => 'Something went wrong'
        ], 400);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if (array_key_exists('phone', $validated)) {
            $user = User::where('phone', $validated['phone'])->first();
        } else {
            $user = User::where('email', $validated['email'])->first();
        }

        if (Hash::check($validated['password'], $user->password)) {
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

        return response([
            'message' => 'Provided credentials are incorrect'
        ], 400);
    }
}

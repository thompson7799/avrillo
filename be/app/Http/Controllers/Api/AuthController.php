<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->safe()->only(['email', 'password']);

        if (! auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'password' => [
                        'Invalid credentials',
                    ],
                ],
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        $authToken = $user->createToken('auth-token', ['access-api'])->plainTextToken;

        return response()->json([
            'access_token' => $authToken,
        ]);
    }
}

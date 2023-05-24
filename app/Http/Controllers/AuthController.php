<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function auth(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            /** @var User $user */
            $user = Auth::user();

            return new JsonResponse([
                'data' => [
                    'token' => $user->createToken('MyApp')->plainTextToken
                ]
            ]);
        }

        return new JsonResponse([
            'message' => 'Unauthorized!'
        ], 401);
    }
}

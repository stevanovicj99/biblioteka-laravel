<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            return new JsonResponse([
                'data' => [
                    'token' => $user->createToken('MyApp')->plainTextToken
                ]
            ]);
        }

        return new JsonResource([
            'message' => 'Unauthorized!'
        ]);
    }
}

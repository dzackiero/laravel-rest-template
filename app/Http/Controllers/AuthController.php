<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(): \Illuminate\Http\JsonResponse
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return $this->errorResponse(__("auth.failed"), 401);
        }
        return $this->successResponse($this->tokenResponse($token));
    }

    public function me(): \Illuminate\Http\JsonResponse
    {
        return $this->successResponse(auth()->user());
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth()->logout();
        return $this->errorResponse("Successfully logged out");
    }

    public function refresh(): \Illuminate\Http\JsonResponse
    {
        return $this->successResponse($this->tokenResponse(auth()->refresh()));
    }

    protected function tokenResponse($token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}

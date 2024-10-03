<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function defaultResponse(string $message, int $code, bool $status, mixed $data = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "status" => $status,
            "message" => $message,
            "data" => $data
        ], $code);
    }

    public function successResponse($data = null, $message = "success", $code = 200): \Illuminate\Http\JsonResponse
    {
        return $this->defaultResponse($message, $code, true, $data);
    }

    public function errorResponse($message = "error occurred", $code = 500, $data = null): \Illuminate\Http\JsonResponse
    {
        return $this->defaultResponse($message, $code, false, $data);
    }
}

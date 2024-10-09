<?php

return [
    "friendly" => [
        \Illuminate\Validation\ValidationException::class => 422, // Unprocessable Entity
        \Illuminate\Auth\AuthenticationException::class => 401, // Unauthorized
        \Illuminate\Auth\Access\AuthorizationException::class => 403, // Forbidden
        \Illuminate\Session\TokenMismatchException::class => 419, // Session Expired
        \Illuminate\Http\Exceptions\PostTooLargeException::class => 413, // Payload Too Large
    ]
];

<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectTo("error", 'error');
        $middleware->prepend(\App\Http\Middleware\Localization::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->shouldRenderJsonWhen(function ($request) {
            if ($request->is("api/*")) {
                return true;
            }
            return $request->expectsJson();
        });

        $exceptions->render(function (Exception $exception) {
            $baseClass = get_class($exception);
            $errorMessage = $exception->getMessage();
            $data = ["exception" => $baseClass];

            if (config("app.env") !== "production") {
                $data = array_merge($data, [
                    "message" => $errorMessage,
                    "file" => $exception->getFile(),
                    "line" => $exception->getLine(),
                    "trace" => $exception->getTrace(),
                ]);
            }

            if ($errorCode = isExceptionUserFriendly($exception)) {
                return response()->json([
                    "status" => false,
                    "message" => $errorMessage,
                    "data" => $data
                ], $errorCode);
            }

            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
                $errorCode = $exception->getStatusCode();
                $errorMessage = $errorMessage ?: __("http-statuses.$errorCode");

                return response()->json([
                    "status" => false,
                    "message" => $errorMessage,
                    "data" => $data
                ], $errorCode);
            }

            if ($exception instanceof \App\Exceptions\WithMessageException) {
                return response()->json([
                    "status" => false,
                    "message" => $exception->getMessage(),
                    "data" => $data
                ], $exception->getCode());
            }

            $errorMessage = config('app.debug') && $errorMessage !== ""
                ? $errorMessage
                : __("http-statuses.defaultError");

            return response()->json([
                "status" => false,
                "message" => $errorMessage,
                "data" => $data
            ], 500);
        });
    })->
    create();

<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class ExceptionHandler
{
    public static function handle(Exceptions $exception): Exceptions
    {
        return $exception
            ->render(self::HandleNotFound(...))
            ->render(function (Throwable $exception) {
                if ($exception instanceof ValidationException) {
                    return response()->json([
                        'message' => $exception->getMessage()
                    ], Response::HTTP_UNPROCESSABLE_ENTITY);
                }
                elseif ($exception instanceof AuthenticationException) {
                    return response()->json([
                        'message' => $exception->getMessage(),
                    ], Response::HTTP_UNAUTHORIZED);
                }
                report($exception);
                return response()->json([
                    'status' => 'error',
                    'message' => $exception->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            });
    }

    private static function handleNotFound(NotFoundHttpException $e): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
        ], Response::HTTP_NOT_FOUND);
    }
}

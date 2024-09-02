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

    private static array $ignore = [
        ValidationException::class,
        AuthenticationException::class,
    ];

    public static function handle(Exceptions $exception): Exceptions
    {
        return $exception
            ->render(self::HandleNotFound(...))
            ->render(function (Throwable $exception) {
                if (self::checkIgnore($exception)) {
                    return false;
                }
                report($exception);

                return response()->json([
                    'status' => 'error',
                    'message' => $exception->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            });
    }

    private static function checkIgnore(Throwable $exception): bool
    {
        foreach (self::$ignore as $ignore) {
            if ($exception instanceof $ignore) {
                return true;
            }
        }
        return false;
    }

    private static function handleNotFound(NotFoundHttpException $e): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => 'the requested data was not found',
        ], Response::HTTP_NOT_FOUND);
    }
}

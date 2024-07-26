<?php

use App\Enums\Error\ErrorMessages;
use App\Enums\Status\StatusCodes;
use App\Exceptions\NotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $exception) {
            if ($exception instanceof ValidationException) {
                return response(['message' => $exception->getMessage()], $exception->status);
            } elseif ($exception instanceof NotFoundHttpException) {
                return response(['message' => $exception->getMessage()], $exception->getStatusCode());
            } elseif ($exception instanceof RouteNotFoundException) {
                return response(['message' => ErrorMessages::Unauthorized->value], StatusCodes::Unauthorized->value);
            } elseif ($exception instanceof NotFoundException) {
                return response(['message' => ErrorMessages::NotFound->value], StatusCodes::NotFound->value);
            } else {
                return response(['message' => $exception->getMessage()], StatusCodes::ServerError->value);
            }
        });
    })->create();

<?php

namespace App\Exceptions;

use App\Enums\Error\ErrorMessages;
use App\Enums\Status\StatusCodes;
use Exception;
use Throwable;

class NotFoundException extends Exception
{
    public function __construct(string $message = ErrorMessages::NotFound->value, int $code = StatusCodes::NotFound->value, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

<?php

namespace App\Exceptions\User;

use App\Enums\Error\ErrorMessages;
use App\Enums\Status\StatusCodes;
use Exception;
use Throwable;

class UserNotRegisteredException extends Exception
{
    public function __construct(string $message = ErrorMessages::UserNotRegistered->value, int $code = StatusCodes::UserNotRegistered->value, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

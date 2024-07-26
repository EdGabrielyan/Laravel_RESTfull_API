<?php

namespace App\Enums\Status;

enum StatusCodes: int {
    case NotFound = 404;
    case Unauthorized = 401;
    case ServerError = 500;
    case Success = 200;
    case UserNotRegistered = 1001;
}

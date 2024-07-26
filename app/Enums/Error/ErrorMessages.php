<?php

namespace App\Enums\Error;

enum ErrorMessages: string {
    case NotFound = 'Not Found';
    case Unauthorized = 'Unauthorized';
    case ServerError = 'Server Error';
    case UserNotRegistered = 'User Not Registered';
}

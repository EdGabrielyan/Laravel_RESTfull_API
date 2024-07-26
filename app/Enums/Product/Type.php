<?php

namespace App\Enums\Product;

enum Type: int
{
    case OnlyDeleted = 1;
    case WithDeleted = 2;
}

<?php

namespace App\Http\Repository\UserCache\Write;

interface UserCacheWriteRepositoryInterface
{
    public function storeIntoCache(string $key, string $prefix): void;
}

<?php

namespace App\Http\Action\User;

use App\Http\Repository\UserCache\Write\UserCacheWriteRepository;
use App\Http\Repository\UserCache\Write\UserCacheWriteRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class UserCacheAction
{
    public function __construct(
        protected UserCacheWriteRepositoryInterface $userCacheRepository,
    )
    {
    }

    public function insertIntoCache(string $key, string $prefix): void
    {
        if (!Cache::has($key)) {
            $this->userCacheRepository->storeIntoCache($key, $prefix);
        }
    }
}

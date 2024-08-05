<?php

namespace App\Http\Action\User;

use App\Http\Repository\UserCache\Write\UserCacheWriteRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Bridge\UserRepository;

class UserCacheAction
{
    public function __construct(
        protected UserCacheWriteRepository $userCacheRepository,
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

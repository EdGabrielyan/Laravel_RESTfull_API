<?php

namespace App\Http\Repository\UserCache\Write;

use Illuminate\Support\Facades\DB;

class UserCacheWriteRepository implements UserCacheWriteRepositoryInterface
{
    public function storeIntoCache(string $key, string $prefix): void
    {
        DB::table('cache_keys')->insert([
            'prefix' => $prefix,
            'key' => $key,
        ]);
    }
}

<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $keys = DB::table('cache_keys')
            ->where('prefix', 'user_index')
            ->select('key')
            ->get()
            ->pluck('key')
            ->toArray();

        foreach ($keys as $key) {
            Cache::forget($key);
        }


        DB::table('cache_keys')->whereIn('key', $keys)->delete();
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        $keys = DB::table('cache_keys')
            ->where('prefix', 'user_index')
            ->select('key')
            ->get()
            ->pluck('key')
            ->toArray();

        foreach ($keys as $key) {
            Cache::forget($key);
        }


        DB::table('cache_keys')->whereIn('key', $keys)->delete();
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $keys = DB::table('cache_keys')
            ->where('prefix', 'user_index')
            ->select('key')
            ->get()
            ->pluck('key')
            ->toArray();

        foreach ($keys as $key) {
            Cache::forget($key);
        }


        DB::table('cache_keys')->whereIn('key', $keys)->delete();
    }
}

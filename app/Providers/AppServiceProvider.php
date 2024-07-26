<?php

namespace App\Providers;

use App\Http\Repository\Product\Read\ProductReadRepository;
use App\Http\Repository\Product\Read\ProductReadRepositoryInterface;
use App\Http\Repository\Product\Write\ProductWriteRepository;
use App\Http\Repository\Product\Write\ProductWriteRepositoryInterface;
use App\Http\Repository\User\Read\UserReadRepository;
use App\Http\Repository\User\Read\UserReadRepositoryInterface;
use App\Http\Repository\User\Write\UserWriteRepository;
use App\Http\Repository\User\Write\UserWriteRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ProductWriteRepositoryInterface::class,
            ProductWriteRepository::class
        );
        $this->app->bind(
            ProductReadRepositoryInterface::class,
            ProductReadRepository::class
        );
        $this->app->bind(
            UserWriteRepositoryInterface::class,
            UserWriteRepository::class
        );
        $this->app->bind(
            UserReadRepositoryInterface::class,
            UserReadRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
//        Passport::tokensExpireIn(now()->addMinutes(15));
//        Passport::refreshTokensExpireIn(now()->addDays(30));
//        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}

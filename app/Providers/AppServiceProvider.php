<?php

namespace App\Providers;

use App\Domain\CursExchange\Services\CBR;
use App\Domain\CursExchange\Services\CurrencyInfo;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(CurrencyInfo::class, function () {
            return new CBR();
        });
    }
}

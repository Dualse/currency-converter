<?php

namespace App\Providers;

use App\Domain\CursExchange\Services\CBR;
use App\Domain\CursExchange\Services\CurrencyInfo;
use App\Domain\CursExchange\Services\SimpleXmlReader;
use App\Domain\CursExchange\Services\XmlReader;
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
        $this->app->bind(XmlReader::class, SimpleXmlReader::class);
        $this->app->bind(CurrencyInfo::class, CBR::class);
    }
}

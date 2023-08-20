<?php

namespace App\Domain\CursExchange\Services;

final class CurrencyConverter
{
    public function __construct(
        private readonly CurrencyInfo $currencyInfo,
    )
    {
    }

    public function convert(int $price, string $currencyCode, string $baseCurrencyCode): float
    {
        return 0;
    }
}

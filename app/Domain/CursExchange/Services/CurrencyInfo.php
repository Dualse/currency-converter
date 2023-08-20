<?php

namespace App\Domain\CursExchange\Services;

use App\Domain\CursExchange\DTO\CurrencyDTO;
use DateTime;

interface CurrencyInfo
{
    /**
     * @param DateTime $date
     * @return array<CurrencyDTO>
     */
    public function getDaily(DateTime $date): array;

    public function getDailyByCharCode(DateTime $date, string $charCode): CurrencyDTO;
}

<?php

namespace App\Jobs;

use App\Domain\CursExchange\Services\CurrencyInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DateTime;

class DailyExchangeCurrencyCursJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly DateTime     $date,
        private readonly CurrencyInfo $currencyInfo
    )
    {
    }

    //Количество попыток выполнить команду
  //  public int $tries = 5;

    public function handle(): void
    {
        $this->currencyInfo->getDaily($this->date);
    }
}

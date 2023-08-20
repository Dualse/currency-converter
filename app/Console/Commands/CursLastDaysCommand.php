<?php

namespace App\Console\Commands;

use App\Domain\CursExchange\Services\CurrencyInfo;
use App\Jobs\DailyExchangeCurrencyCursJob;
use Illuminate\Console\Command;
use DatePeriod;
use DateTime;
use DateInterval;

class CursLastDaysCommand extends Command
{
    protected $signature = 'curs:last-days {count=180}';

    protected $description = 'Command description';

    public function __construct(private readonly CurrencyInfo $currencyInfo)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $count = $this->argument('count');

        $dates = new DatePeriod(
            (new DateTime())->sub(new DateInterval("P{$count}D")),
            new DateInterval('P1D'),
            new DateTime()
        );
        foreach ($dates as $date) {
            $this->info('dispatch job by date: ' . $date->format('Y-m-d'));
            dispatch(new DailyExchangeCurrencyCursJob($date, $this->currencyInfo));

        }
        $this->info("Count: {$count}");
    }
}

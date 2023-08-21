<?php

namespace App\Domain\CursExchange\Services;

use App\Domain\CursExchange\DTO\CurrencyDTO;
use Exception;
use DateTime;

final class CBR implements CurrencyInfo
{
    const DAILY = 'https://www.cbr.ru/scripts/XML_daily.asp';

    /**
     * @param DateTime $date
     * @return array<CurrencyDTO>
     * @throws Exception
     */
    public function getDaily(DateTime $date): array
    {
        if ($date->diff(new DateTime())->s < 0) {
            throw new Exception('Date must be in the past.');
        }

        $cacheKey = 'cbr_daily_exchange_rate_' . $date->getTimestamp();


        if (cache($cacheKey)) {
            return array_map(fn($item) => new CurrencyDTO(
                charCode: $item['CharCode'],
                nominal: $item['Nominal'],
                name: $item['Name'],
                value: floatval(str_replace(',', '.', $item['Value']))
            ), cache($cacheKey));
        }

        try {
            $xml = simplexml_load_file(self::DAILY . '?' . http_build_query([
                    'date_req' => $date->format('d/m/Y'),
                ]));
            $json = json_encode($xml);
            $data = json_decode($json, true);

            cache([
                $cacheKey => $data['Valute']
            ]);

            return array_map(fn($item) => new CurrencyDTO(
                charCode: $item['CharCode'],
                nominal: $item['Nominal'],
                name: $item['Name'],
                value: floatval(str_replace(',', '.', $item['Value']))
            ), $data['Valute']);
        } catch (Exception $e) {
            throw new Exception('CBR daily exchange rate is not available. ' . $e->getMessage());
        }
    }

    /**
     * @param DateTime $date
     * @param string $charCode
     * @param string $baseCurrencyChar
     * @return CurrencyDTO
     * @throws Exception
     */
    public function getDailyByCharCode(DateTime $date, string $charCode): CurrencyDTO
    {
        $currency = collect($this->getDaily($date))
            ->first(fn(CurrencyDTO $currency) => $currency->getCharCode() === $charCode);

        if (!$currency) {
            throw new Exception('Currency with char code ' . $charCode . ' not found.');
        }

        return $currency;
    }

    /**
     * @param DateTime $date
     * @param string $charCode
     * @param string $baseCurrencyChar
     * @return float
     * @throws Exception
     */
    public function getCurrency(DateTime $date, string $charCode, string $baseCurrencyChar = 'RUR'): float
    {
        $currencies = collect($this->getDaily($date));
        $currency = $currencies->first(fn(CurrencyDTO $currency) => $currency->getCharCode() === $charCode);

        if (!$currency) {
            throw new Exception('Currency with char code ' . $charCode . ' not found.');
        }

        if ($baseCurrencyChar !== 'RUR') {
            $baseCurrency = $currencies->first(fn(CurrencyDTO $currency) => $currency->getCharCode() === $baseCurrencyChar);

            if (!$baseCurrency){
                throw new Exception('Base currency with char code ' . $baseCurrencyChar . ' not found.');
            }

            return floatval(
                ($currency->getValue() / $currency->getNominal()) /
                ($baseCurrency->getValue() / $baseCurrency->getNominal())
            );
        }

        return floatval($currency->getValue() / $currency->getNominal());
    }
}

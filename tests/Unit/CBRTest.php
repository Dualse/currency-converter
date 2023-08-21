<?php

namespace Tests\Unit;

use App\Domain\CursExchange\Services\SimpleXmlReader;
use App\Domain\CursExchange\Services\XmlReader;
use Tests\Mocks\StorageXmlReader;
use Tests\TestCase;

class CBRTest extends TestCase
{
    public function test_get_currency_rate(): void
    {
        $xmlReader = $this->instance(XmlReader::class, new StorageXmlReader());

        $cbr = new \App\Domain\CursExchange\Services\CBR($xmlReader);
        $response = $cbr->getCurrency(new \DateTime(), 'USD');

        $this->assertTrue(93.4047 === $response);
    }
}

<?php

namespace App\Domain\CursExchange\Services;

class SimpleXmlReader implements XmlReader
{

    /**
     * @param string $url
     * @return array
     */
    public function read(string $url): array
    {
        $xml = simplexml_load_file($url);
        $json = json_encode($xml);

        return json_decode($json, true);
    }
}

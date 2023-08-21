<?php

namespace Tests\Mocks;

use Illuminate\Support\Facades\Storage;

class StorageXmlReader implements \App\Domain\CursExchange\Services\XmlReader
{

    public function read(string $url): array
    {
        $xml = simplexml_load_string(file_get_contents(storage_path(explode('?', $url)[0])));
        $json = json_encode($xml);

        return json_decode($json, true) ?? [];
    }
}

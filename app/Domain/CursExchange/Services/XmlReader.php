<?php

namespace App\Domain\CursExchange\Services;

interface XmlReader
{
    public function read(string $url): array;
}

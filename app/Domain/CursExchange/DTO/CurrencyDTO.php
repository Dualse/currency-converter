<?php

namespace App\Domain\CursExchange\DTO;

final class CurrencyDTO
{
    public function __construct(
        private readonly string $charCode,
        private readonly int    $nominal,
        private readonly string $name,
        private readonly float  $value,
    )
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCharCode(): string
    {
        return $this->charCode;
    }

    /**
     * @return int
     */
    public function getNominal(): int
    {
        return $this->nominal;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }
}

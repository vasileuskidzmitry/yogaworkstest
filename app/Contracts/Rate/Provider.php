<?php

declare(strict_types=1);

namespace App\Contracts\Rate;

interface Provider
{
    /**
     * Provide exchange rates of specified currency
     *
     * @param string $baseCurrency
     *
     * @return array<int, Rate>
     */
    public function get(string $baseCurrency): array;
}

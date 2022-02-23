<?php

declare(strict_types=1);

namespace App\Contracts\Rate;

use Illuminate\Http\Client\Response;

interface ProviderResponseConverter
{
    /**
     * Convert rate provider http response into array of rate models
     *
     * @param Response $response
     * @param string $baseCurrency
     *
     * @return array<int, Rate>
     */
    public function convert(Response $response, string $baseCurrency): array;
}

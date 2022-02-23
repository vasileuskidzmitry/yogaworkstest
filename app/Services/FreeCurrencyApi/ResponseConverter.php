<?php

declare(strict_types=1);

namespace App\Services\FreeCurrencyApi;

use App\Contracts\Rate\ProviderResponseConverter as ProviderResponseConverterContract;
use App\Models\Rate;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class ResponseConverter implements ProviderResponseConverterContract
{
    /**
     * @inheritDoc
     */
    public function convert(Response $response, string $baseCurrency): array
    {
        $converted = [];

        $timestamp = $this->getTimestamp($response);
        $rates = $this->getRates($response, $baseCurrency);

        foreach ($rates as $currencyCode => $rate) {
            $converted[] = Rate::make([
                'base_currency_code' => $baseCurrency,
                'target_currency_code' => $currencyCode,
                'rate' => $rate,
                'timestamp' => Carbon::createFromTimestamp($timestamp)->setMinutes(0)->setSeconds(0),
            ]);
        }

        return $converted;
    }

    /**
     * Extract timestamp
     *
     * @param Response $response
     *
     * @return int
     */
    private function getTimestamp(Response $response): int
    {
        return (int) $response->json('query.timestamp');
    }

    /**
     * Extract and prepare rates array
     *
     * @param Response $response
     * @param string $currencyCode
     *
     * @return array<string, float>
     */
    private function getRates(Response $response, string $currencyCode): array
    {
        $rates = $response->json('data');

        $supportedCurrencyCodes = [];

        foreach (config('currencies', []) as $currency) {
            if ($currency['code'] === $currencyCode) {
                continue;
            }

            $supportedCurrencyCodes[] = $currency['code'];
        }

        return array_filter(
            $rates,
            fn (string $currencyCode): bool => in_array($currencyCode, $supportedCurrencyCodes, true),
            ARRAY_FILTER_USE_KEY
        );
    }
}

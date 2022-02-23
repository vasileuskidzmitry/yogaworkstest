<?php

declare(strict_types=1);

namespace App\Services\FreeCurrencyApi;

use App\Contracts\Rate\Provider as RateProviderContract;
use App\Contracts\Rate\ProviderResponseConverter as RateProviderConverterContract;
use Illuminate\Support\Facades\Http;
use App\Models\Rate;

class Provider implements RateProviderContract
{
    public function __construct(private RateProviderConverterContract $converter)
    {
    }

    /**
     * @inheritDoc
     */
    public function get(string $baseCurrency): array
    {
        $response = Http::freecurrencyapi()->get(
            '/latest',
            [
                'apikey' => config('services.free_currency_api.key', ''),
                'base_currency' => $baseCurrency,
            ]
        );

        return $this->converter->convert($response, $baseCurrency);
    }
}

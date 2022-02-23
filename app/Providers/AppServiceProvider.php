<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\Rate\Provider as ProviderContract;
use App\Contracts\Rate\ProviderResponseConverter as ProviderResponseConverterContract;
use App\Contracts\Rate\Updater as UpdaterContract;
use App\Services\FreeCurrencyApi\ResponseConverter as FreeCurrencyApiResponseConverter;
use App\Services\FreeCurrencyApi\Provider as FreeCurrencyApiProvider;
use App\Services\RateUpdater;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UpdaterContract::class, RateUpdater::class);
        $this->app->bind(ProviderContract::class, FreeCurrencyApiProvider::class);

        $this->app->when(FreeCurrencyApiProvider::class)
            ->needs(ProviderResponseConverterContract::class)
            ->give(FreeCurrencyApiResponseConverter::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Http::macro('freecurrencyapi', function () {
           return Http::baseUrl(config('services.free_currency_api.endpoint', ''))
               ->acceptJson()
               ->timeout(3)
               ->retry(3, 100);
        });
    }
}

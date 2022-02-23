<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Rate\Provider as RateProviderContract;
use App\Contracts\Rate\Updater as UpdaterContract;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class RateUpdater implements UpdaterContract
{
    public function __construct(private RateProviderContract $rateProvider)
    {
    }

    /**
     * @inheritDoc
     */
    public function update(): void
    {
        $rates = [];

        foreach (config('currencies', []) as $currency) {
            array_push($rates, ...$this->rateProvider->get($currency['code']));
        }

        DB::transaction(function () use ($rates) {
            foreach ($rates as $rate) {
                $rate->save();
            }
        });
    }
}

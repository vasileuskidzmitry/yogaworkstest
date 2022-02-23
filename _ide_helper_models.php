<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Currency
 *
 * @property string $code
 * @property string $title
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereTitle($value)
 * @mixin \Eloquent
 */
	class IdeHelperCurrency {}
}

namespace App\Models{
/**
 * App\Models\Rate
 *
 * @property int $id
 * @property string $base_currency_code
 * @property string $target_currency_code
 * @property float $rate
 * @property \Illuminate\Support\Carbon $timestamp
 * @property-read \App\Models\Currency|null $base_currency
 * @property-read \App\Models\Currency|null $target_currency
 * @method static \Illuminate\Database\Eloquent\Builder|Rate forOneDay()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate of(string $currencyCode)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereBaseCurrencyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereTargetCurrencyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereTimestamp($value)
 * @mixin \Eloquent
 */
	class IdeHelperRate {}
}


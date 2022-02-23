<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * @mixin IdeHelperRate
 */
class Rate extends Model
{
    /**
     * @inheritDoc
     */
    public $timestamps = false;

    /**
     * @inheritDoc
     */
    protected $visible = [
        'base_currency',
        'target_currency',
        'rate',
        'timestamp',
    ];

    /**
     * @inheritDoc
     */
    protected $casts = [
       'timestamp' => 'datetime',
    ];

    /**
     * @inheritDoc
     */
    protected $with = [
        'base_currency',
        'target_currency',
    ];

    /**
     * @inheritDoc
     */
    protected $fillable = [
        'base_currency_code',
        'target_currency_code',
        'rate',
        'timestamp',
    ];

    /**
     * Declare base currency relation
     *
     * @return HasOne
     */
    public function base_currency(): HasOne
    {
        return $this->hasOne(Currency::class, 'code', 'base_currency_code');
    }

    /**
     * Declare target currency relation
     *
     * @return HasOne
     */
    public function target_currency(): HasOne
    {
        return $this->hasOne(Currency::class, 'code', 'target_currency_code');
    }

    /**
     * Declare "of" scope
     *
     * @param Builder $query
     * @param string $currencyCode
     *
     * @return Builder
     */
    public function scopeOf(Builder $query, string $currencyCode): Builder
    {
        return $query->where('base_currency_code', $currencyCode);
    }

    /**
     * Declare "forOneDay" scope
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeForOneDay(Builder $query): Builder
    {
        return $query->where('timestamp', '>=', Carbon::now()->subDay());
    }
}

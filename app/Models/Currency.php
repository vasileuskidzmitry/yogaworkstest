<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperCurrency
 */
class Currency extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    public $primaryKey = 'code';

    /**
     * @var string
     */
    public $keyType = 'string';

    /**
     * @var string[]
     */
    protected $fillable = [
        'code',
        'title',
    ];
}

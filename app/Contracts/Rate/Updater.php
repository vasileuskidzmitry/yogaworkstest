<?php

declare(strict_types=1);

namespace App\Contracts\Rate;

interface Updater
{
    /**
     * Retrieve and save latest rates
     *
     * @return void
     *
     * @throws \Throwable
     */
    public function update(): void;
}

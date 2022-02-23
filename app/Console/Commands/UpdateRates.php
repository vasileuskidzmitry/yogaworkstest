<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\RateUpdater;
use Illuminate\Console\Command;

class UpdateRates extends Command
{
    /**
     * @inheritDoc
     */
    protected $signature = 'rates:update';

    /**
     * @inheritDoc
     */
    protected $description = 'Update rates data';

    /**
     * Execute the console command
     *
     * @param RateUpdater $rateUpdater
     *
     * @return int
     */
    public function handle(RateUpdater $rateUpdater): int
    {
        try {
            $rateUpdater->update();
        } catch (\Throwable $e) {
            $this->output->error($e->getMessage());

            return 1;
        }

        $this->output->success('Rates have been updated successfuly');

        return 0;
    }
}

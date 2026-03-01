<?php

namespace App\Jobs;

use App\Services\CryptoServices;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessCrypto implements ShouldQueue
{
    use Queueable;

    public int $timeout = 120;


    /**
     * Execute the job.
     */
    public function handle(CryptoServices $service): void
    {
        $service->updateCryptoPrices();
    }
}

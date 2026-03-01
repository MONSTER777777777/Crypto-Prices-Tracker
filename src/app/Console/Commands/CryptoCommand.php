<?php

namespace App\Console\Commands;

use App\Jobs\ProcessCrypto;
use Illuminate\Console\Command;

class CryptoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:crypto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and update crypto prices from external API';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        ProcessCrypto::dispatch();
        $this->info('Job dispatched successfully!');
        return Command::SUCCESS;
    }
}

<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Commands;

use Illuminate\Console\Command;

class LaravelWalletEventSourcingCommand extends Command
{
    public $signature = 'laravel-wallet-event-sourcing';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}

<?php

namespace Vanthao03596\LaravelWalletEventSourcing;

use Illuminate\Support\ServiceProvider;

class LaravelWalletEventSourcingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/wallet-event-sourcing.php' => config_path('wallet-event-sourcing.php'),
            ], 'config');
        }
    }
}

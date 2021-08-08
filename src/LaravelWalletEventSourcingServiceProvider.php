<?php

declare(strict_types=1);

namespace Vanthao03596\LaravelWalletEventSourcing;

use Illuminate\Support\ServiceProvider;

class LaravelWalletEventSourcingServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/wallet-event-sourcing.php' => config_path('wallet-event-sourcing.php'),
            ], 'config');
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/wallet-event-sourcing.php', 'wallet-event-sourcing');
    }
}

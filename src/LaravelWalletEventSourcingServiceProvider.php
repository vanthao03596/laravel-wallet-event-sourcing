<?php

namespace Vanthao03596\LaravelWalletEventSourcing;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Vanthao03596\LaravelWalletEventSourcing\Commands\LaravelWalletEventSourcingCommand;

class LaravelWalletEventSourcingServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-wallet-event-sourcing')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-wallet-event-sourcing_table')
            ->hasCommand(LaravelWalletEventSourcingCommand::class);
    }
}

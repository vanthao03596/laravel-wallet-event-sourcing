<?php

declare(strict_types=1);

namespace Vanthao03596\LaravelWalletEventSourcing;

use Dyrynda\Database\LaravelEfficientUuidServiceProvider;
use Spatie\EventSourcing\EventSourcingServiceProvider;
use Spatie\EventSourcing\Projectionist;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Vanthao03596\LaravelWalletEventSourcing\Projectors\WalletProjector;

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
             ->hasMigrations([
                 'create_snapshots_table',
                 'create_stored_events_table',
                 'create_wallet_event_sourcing_table',
             ]);
    }

    public function registeringPackage(): void
    {
        $this->app->register(LaravelEfficientUuidServiceProvider::class);
        $this->app->register(EventSourcingServiceProvider::class);
    }

    public function packageRegistered(): void
    {
        $projectionist = $this->app->get(Projectionist::class);

        $projectionist->addProjectors([
            WalletProjector::class,
        ]);
    }
}

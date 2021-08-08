<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Vanthao03596\LaravelWalletEventSourcing\LaravelWalletEventSourcingServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Vanthao03596\\LaravelWalletEventSourcing\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelWalletEventSourcingServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        include_once __DIR__.'/../database/migrations/create_laravel-wallet-event-sourcing_table.php.stub';
        (new \CreatePackageTable())->up();
        */
    }
}

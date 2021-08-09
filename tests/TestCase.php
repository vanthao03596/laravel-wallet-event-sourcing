<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Tests;

use Dyrynda\Database\LaravelEfficientUuidServiceProvider;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\EventSourcing\EventSourcingServiceProvider;
use Vanthao03596\LaravelWalletEventSourcing\LaravelWalletEventSourcingServiceProvider;

class TestCase extends Orchestra
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Vanthao03596\\LaravelWalletEventSourcing\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            EventSourcingServiceProvider::class,
            LaravelEfficientUuidServiceProvider::class,
            LaravelWalletEventSourcingServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }

    public function refreshServiceProvider()
    {
        app(LaravelWalletEventSourcingServiceProvider::class, ['app' => $this->app])
            ->register()
            ->boot();
    }

    protected function setUpDatabase()
    {
        Schema::dropIfExists('snapshots');
        include_once __DIR__.'/../database/migrations/create_snapshots_table.php.stub';
        (new \CreateSnapshotsTable())->up();

        Schema::dropIfExists('stored_events');
        include_once __DIR__.'/../database/migrations/create_stored_events_table.php.stub';
        (new \CreateStoredEventsTable())->up();

        include_once __DIR__.'/../database/migrations/create_wallet_event_sourcing_table.php.stub';
        (new \CreateWalletEventSourcingTable())->down();
        (new \CreateWalletEventSourcingTable())->up();

        include_once __DIR__.'/database/migrations/create_users_table.php.stub';
        (new \CreateUsersTable())->up();

        $this->app[Kernel::class]->setArtisan(null);

        RefreshDatabaseState::$migrated = true;
    }
}

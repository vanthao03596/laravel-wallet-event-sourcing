<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Tests;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Spatie\EventSourcing\Commands\CommandBus;
use Vanthao03596\LaravelWalletEventSourcing\Aggregates\WalletAggregate;
use Vanthao03596\LaravelWalletEventSourcing\Commands\CreateWallet;
use Vanthao03596\LaravelWalletEventSourcing\Projections\WalletProjection;
use Vanthao03596\LaravelWalletEventSourcing\Support\Holder;
use Vanthao03596\LaravelWalletEventSourcing\Tests\Models\User;

class WalletTest extends TestCase
{
    private Model | Holder $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test */
    public function can_create_wallet()
    {
        $uuid = Uuid::uuid4()->toString();

        /** @var CommandBus $bus */
        $bus = app(abstract: CommandBus::class);

        /** @var Holder $user */
        $user = User::factory()->create();

        $bus->dispatch(command: new CreateWallet(
            uuid: $uuid,
            name: 'default wallet',
            holder: $user,
            meta: null,
        ));

        $this->assertDatabaseHas(table: WalletProjection::class, data: [
            'name' => 'default wallet',
            'holder_type' => $user->getMorphClass(),
            'holder_id' => $user->getKey(),
        ]);
    }

    /** @test */
    public function can_delete_wallet()
    {
        $uuid = Uuid::uuid4()->toString();

        /** @var CommandBus $bus */
        $bus = app(abstract: CommandBus::class);

        /** @var Holder $user */
        $user = User::factory()->create();

        $bus->dispatch(command: new CreateWallet(
            uuid: $uuid,
            name: 'default wallet',
            holder: $user,
            meta: null,
        ));

        $this->assertDatabaseHas(table: WalletProjection::class, data: [
            'name' => 'default wallet',
            'holder_type' => $user->getMorphClass(),
            'holder_id' => $user->getKey(),
        ]);

        WalletAggregate::retrieve(uuid: $uuid)
            ->delete()
            ->persist();

        $this->assertDatabaseMissing(table: WalletProjection::class, data: [
            'name' => 'default wallet',
            'holder_type' => $user->getMorphClass(),
            'holder_id' => $user->getKey(),
        ]);
    }
}

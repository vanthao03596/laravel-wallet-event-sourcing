<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Tests;

use Ramsey\Uuid\Uuid;
use Spatie\EventSourcing\Commands\CommandBus;
use Vanthao03596\LaravelWalletEventSourcing\Commands\CreateWallet;
use Vanthao03596\LaravelWalletEventSourcing\Projections\WalletProjection;
use Vanthao03596\LaravelWalletEventSourcing\Support\Holder;
use Vanthao03596\LaravelWalletEventSourcing\Tests\Models\User;

class WalletTest extends TestCase
{
    public function test_create_wallet()
    {
        $uuid = Uuid::uuid4()->toString();

        $bus = app(CommandBus::class);

        /** @var Holder $user */
        $user = User::factory()->create();

        $bus->dispatch(new CreateWallet(
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
}

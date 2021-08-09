<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Tests;

use Illuminate\Database\Eloquent\Model;
use Vanthao03596\LaravelWalletEventSourcing\Aggregates\WalletAggregate;
use Vanthao03596\LaravelWalletEventSourcing\Commands\CreateWallet;
use Vanthao03596\LaravelWalletEventSourcing\Events\WalletCreated;
use Vanthao03596\LaravelWalletEventSourcing\Events\WalletDeleted;
use Vanthao03596\LaravelWalletEventSourcing\Support\Holder;
use Vanthao03596\LaravelWalletEventSourcing\Tests\Models\User;

class WalletAggregateRootTest extends TestCase
{
    private const WALLET_UUID = 'wallet-uuid';

    private Model | Holder $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test */
    public function can_create_wallet()
    {
        WalletAggregate::fake(uuid: self::WALLET_UUID)
            ->given(events: [])
            ->when(callable: function (WalletAggregate $walletAggregate): string {
                $walletAggregate->create(command: new CreateWallet(
                    uuid: self::WALLET_UUID,
                    name: 'default wallet',
                    holder: $this->user,
                    meta: null,
                ));

                return $walletAggregate->uuid();
            })
            ->assertRecorded(expectedEvents: [
                new WalletCreated(
                    name: 'default wallet',
                    holderType: $this->user->getMorphClass(),
                    holderId: $this->user->getKey(),
                    meta: null,
                )
            ]);

    }

    /** @test */
    public function can_delete_wallet()
    {
        WalletAggregate::fake(uuid: self::WALLET_UUID)
            ->given(events: [new WalletCreated(
                name: 'default wallet',
                holderType: $this->user->getMorphClass(),
                holderId: $this->user->getKey(),
                meta: null,
            )])
            ->when(callable: function (WalletAggregate $walletAggregate) {
                $walletAggregate->delete();
            })
            ->assertRecorded(expectedEvents: [
                new WalletDeleted()
            ]);

    }
}

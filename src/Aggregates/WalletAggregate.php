<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Aggregates;

use Spatie\EventSourcing\AggregateRoots\AggregateRoot;
use Vanthao03596\LaravelWalletEventSourcing\Commands\CreateWallet;
use Vanthao03596\LaravelWalletEventSourcing\Events\WalletCreated;
use Vanthao03596\LaravelWalletEventSourcing\Events\WalletDeleted;
use Vanthao03596\LaravelWalletEventSourcing\Events\WalletDeposited;

class WalletAggregate extends AggregateRoot
{
    public function create(CreateWallet $command): self
    {
        $this->recordThat(
            new WalletCreated(
                name: $command->getName(),
                holderType: $command->getHolder()->getMorphClass(),
                holderId: $command->getHolder()->getKey(),
                meta: $command->getMeta()
            )
        );

        return $this;
    }

    public function delete(): self
    {
        $this->recordThat(new WalletDeleted());

        return $this;
    }

    public function deposit(int | float $amount)
    {
        $this->recordThat(new WalletDeposited($amount));

        return $this;
    }
}

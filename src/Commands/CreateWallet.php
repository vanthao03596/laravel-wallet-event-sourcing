<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Commands;

use Spatie\EventSourcing\Commands\AggregateUuid;
use Spatie\EventSourcing\Commands\HandledBy;
use Vanthao03596\LaravelWalletEventSourcing\Aggregates\WalletAggregate;
use Vanthao03596\LaravelWalletEventSourcing\Support\Holder;

#[HandledBy(WalletAggregate::class)]
class CreateWallet
{
    public function __construct(
        #[AggregateUuid] public string $uuid,
        private string $name,
        private Holder $holder,
        private ?array $meta
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHolder(): Holder
    {
        return $this->holder;
    }

    public function getMeta(): ?array
    {
        return $this->meta;
    }
}

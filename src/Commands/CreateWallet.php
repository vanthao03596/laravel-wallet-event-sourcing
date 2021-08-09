<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Commands;

use Illuminate\Database\Eloquent\Model;
use Spatie\EventSourcing\Commands\AggregateUuid;
use Spatie\EventSourcing\Commands\HandledBy;
use Vanthao03596\LaravelWalletEventSourcing\Aggregates\WalletAggregate;

#[HandledBy(WalletAggregate::class)]
class CreateWallet
{
    public function __construct(
        #[AggregateUuid] public string $uuid,
        private string $name,
        private Model $holder,
        private ?array $meta
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHolder(): Model
    {
        return $this->holder;
    }

    public function getMeta(): ?array
    {
        return $this->meta;
    }
}

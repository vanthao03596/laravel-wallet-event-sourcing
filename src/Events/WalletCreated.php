<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class WalletCreated extends ShouldBeStored
{
    public function __construct(
        public string $name,
        public string $holderType,
        public int | string $holderId,
        public ?array $meta
    ) {
    }
}

<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class WalletDeposited extends ShouldBeStored
{
    public function __construct(
        public int | float $amount
    ) {
    }
}

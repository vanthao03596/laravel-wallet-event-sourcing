<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Events;

use Illuminate\Database\Eloquent\Model;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class WalletCreated extends ShouldBeStored
{
    public function __construct(
        public string $name,
        public Model $holder,
        public ?array $meta
    ) {
    }
}

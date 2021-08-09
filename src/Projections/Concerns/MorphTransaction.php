<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Projections\Concerns;

use Illuminate\Database\Eloquent\Relations\MorphOne;
use Vanthao03596\LaravelWalletEventSourcing\Projections\TransactionProjection;

trait MorphTransaction
{
    public function transaction(): MorphOne
    {
        return $this->morphOne(related: TransactionProjection::class, name: 'transactionable');
    }
}

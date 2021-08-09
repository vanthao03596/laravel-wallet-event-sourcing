<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Projections\Concerns;

use Vanthao03596\LaravelWalletEventSourcing\Projections\TransactionProjection;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait MorphTransaction
{
    public function transaction(): MorphOne
    {
        return $this->morphOne(related: TransactionProjection::class, name: 'transactionable');
    }
}

<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Projections;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Spatie\EventSourcing\Projections\Projection;
use Vanthao03596\LaravelWalletEventSourcing\Projections\Concerns\MorphTransaction;

class DepositProjection extends Projection
{
    use MorphTransaction;
    use GeneratesUuid;

    protected $table = 'transaction_deposits';

    protected $guarded = [];

    protected $casts = [
        'uuid' => EfficientUuid::class,
    ];
}

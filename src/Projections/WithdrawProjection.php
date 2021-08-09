<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Projections;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Spatie\EventSourcing\Projections\Projection;
use Vanthao03596\LaravelWalletEventSourcing\Projections\Concerns\MorphTransaction;

class WithdrawProjection extends Projection
{
    use MorphTransaction;
    use GeneratesUuid;

    protected $table = 'transaction_withdraws';

    protected $guarded = [];

    protected $casts = [
        'uuid' => EfficientUuid::class,
    ];
}

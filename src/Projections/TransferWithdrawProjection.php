<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Projections;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\EventSourcing\Projections\Projection;
use Vanthao03596\LaravelWalletEventSourcing\Projections\Concerns\MorphTransaction;

class TransferWithdrawProjection extends Projection
{
    use MorphTransaction;
    use GeneratesUuid;

    protected $table = 'transaction_transfer_withdraws';

    protected $guarded = [];

    protected $casts = [
        'uuid' => EfficientUuid::class,
    ];

    public function destinationWallet(): BelongsTo
    {
        return $this->belongsTo(related: WalletProjection::class, foreignKey: 'destination_wallet_uuid');
    }
}

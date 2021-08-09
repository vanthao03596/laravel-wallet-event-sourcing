<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Projections;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\EventSourcing\Projections\Projection;
use Vanthao03596\LaravelWalletEventSourcing\Projections\Concerns\MorphTransaction;

class TransferDepositProjection extends Projection
{
    use MorphTransaction;
    use GeneratesUuid;

    protected $table = 'transaction_transfer_deposits';

    protected $guarded = [];

    protected $casts = [
        'uuid' => EfficientUuid::class,
    ];

    public function sourceWallet(): BelongsTo
    {
        return $this->belongsTo(related: WalletProjection::class, foreignKey: 'source_wallet_uuid');
    }
}

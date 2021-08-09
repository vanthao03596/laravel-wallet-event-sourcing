<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Projections;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\EventSourcing\Projections\Projection;

class TransactionProjection extends Projection
{
    use GeneratesUuid;

    protected $table = 'transactions';

    protected $guarded = [];

    protected $casts = [
        'uuid' => EfficientUuid::class,
        'transactionable_id' => EfficientUuid::class,
    ];

    public function transactionable(): MorphTo
    {
        return $this->morphTo();
    }

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(related: WalletProjection::class, foreignKey: 'wallet_uuid');
    }

    public function uuidColumns(): array
    {
        return ['uuid', 'transactionable_id'];
    }
}

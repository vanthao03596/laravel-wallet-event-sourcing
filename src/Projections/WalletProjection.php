<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Projections;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\EventSourcing\Projections\Projection;

class WalletProjection extends Projection
{
    use GeneratesUuid;

    protected $table = 'wallets';

    protected $guarded = [];

    protected $casts = [
        'uuid' => EfficientUuid::class,
        'meta' => 'json',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(related: TransactionProjection::class, foreignKey: 'wallet_uuid');
    }

    public function holder(): MorphTo
    {
        return $this->morphTo();
    }
}

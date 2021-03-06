<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Projectors;

use Illuminate\Support\Str;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;
use Vanthao03596\LaravelWalletEventSourcing\Events\WalletCreated;
use Vanthao03596\LaravelWalletEventSourcing\Events\WalletDeleted;
use Vanthao03596\LaravelWalletEventSourcing\Events\WalletDeposited;
use Vanthao03596\LaravelWalletEventSourcing\Projections\DepositProjection;
use Vanthao03596\LaravelWalletEventSourcing\Projections\TransactionProjection;
use Vanthao03596\LaravelWalletEventSourcing\Projections\WalletProjection;

class WalletProjector extends Projector
{
    public function onWalletCreated(WalletCreated $event): void
    {
        WalletProjection::new()
            ->writeable()
            ->fill(attributes: [
                'uuid' => $event->aggregateRootUuid(),
                'name' => $event->name,
                'slug' => Str::slug($event->name),
                'meta' => $event->meta,
                'holder_type' => $event->holderType,
                'holder_id' => $event->holderId,
                'currency' => $event->currency,
                'created_at' => $event->date,
            ])
            ->save();
    }

    public function onWalletDeleted(WalletDeleted $event): void
    {
        $wallet = WalletProjection::whereUuid(uuid: $event->aggregateRootUuid())
            ->firstOrFail();

        $wallet->writeable()->delete();
    }

    public function onWalletDeposited(WalletDeposited $event): void
    {
        $wallet = WalletProjection::whereUuid(uuid: $event->aggregateRootUuid())
            ->firstOrFail();

        $deposit = tap(DepositProjection::new()
            ->writeable()
            ->fill(attributes: [
                'amount' => $event->amount,
            ]))
            ->save();


        $transaction = TransactionProjection::new()
            ->writeable()
            ->fill(attributes: [
                'type' => 'deposit',
                'amount' => $event->amount,
            ]);

        $transaction->wallet()->associate(model: $wallet);
        $transaction->transactionable()->associate(model: $deposit);

        $transaction->save();

        $wallet->writeable()->increment(column: 'balance', amount: $event->amount);
    }
}

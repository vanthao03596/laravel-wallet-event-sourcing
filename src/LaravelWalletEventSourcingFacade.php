<?php

namespace Vanthao03596\LaravelWalletEventSourcing;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Vanthao03596\LaravelWalletEventSourcing\LaravelWalletEventSourcing
 */
class LaravelWalletEventSourcingFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-wallet-event-sourcing';
    }
}

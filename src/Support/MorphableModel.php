<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Support;

interface MorphableModel
{
    /**
     * @return mixed
     */
    public function getKey();

    /**
     * @return mixed
     */
    public function getMorphClass();
}

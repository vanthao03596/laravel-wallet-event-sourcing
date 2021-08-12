<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Casts;

use Brick\Money\Currency;
use Brick\Money\Money;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class MoneyCast implements CastsAttributes
{
    protected ?string $currency;

    public function __construct(string $currency = null)
    {
        $this->currency = $currency;
    }

    public function get($model, string $key, $value, array $attributes)
    {
        if ($value === null) {
            return null;
        }

        return Money::of($value, $this->getCurrency($attributes));
    }

    public function set($model, string $key, $value, array $attributes): array
    {
        if ($value === null) {
            return [$key => $value];
        }

        $money = $value;

        $currency = $this->getCurrency($attributes);

        if (! $money instanceof Money) {
            $money = Money::of($value, $currency);
        }

        if ($this->currency) {
            return [
                $key => (string)$money->getAmount(),
                $this->currency => $money->getCurrency()->getCurrencyCode(),
            ];
        }

        return [
            $key => (string)$money->getAmount(),
        ];
    }

    protected function getCurrency(array $attributes): Currency
    {
        $defaultCurrencyCode = config('wallet-event-sourcing.default_currency');

        $code = $attributes[$this->currency] ?? $defaultCurrencyCode;

        return Currency::of($code);
    }
}

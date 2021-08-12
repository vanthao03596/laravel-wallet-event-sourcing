<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Tests;

use Brick\Money\Money;
use Vanthao03596\LaravelWalletEventSourcing\Tests\Models\User;

class MoneyCastTest extends TestCase
{
    /** @test */
    public function it_casts_money_when_retrieving_casted_values()
    {
        /** @var User $user */
        $user = User::create([
            'email' => 'test@gmail.com',
            'money' => null,
            'wage' => 50000,
            'debits' => 1234.56,
            'currency' => 'AUD',
        ]);

        $this->assertNull($user->money);
        $this->assertInstanceOf(Money::class, $user->wage);
        $this->assertInstanceOf(Money::class, $user->debits);

        $this->assertSame('1234.56', (string)$user->debits->getAmount());
        $this->assertSame('AUD', $user->debits->getCurrency()->getCurrencyCode());

        $this->assertSame('50000.00', (string)$user->wage->getAmount());
        $this->assertSame('USD', $user->wage->getCurrency()->getCurrencyCode());

        $user->money = 100.99;

        $this->assertSame('100.99', (string)$user->money->getAmount());
        $this->assertSame('USD', $user->money->getCurrency()->getCurrencyCode());

        $user->save();

        $this->assertSame(1, $user->id);

        $this->assertDatabaseHas('users', [
            'id' => 1,
            'money' => 100.99,
            'wage' => 50000.00,
            'debits' => 1234.56,
            'currency' => 'AUD',
        ]);

        $user->wage = Money::of(10000, 'USD');

        $this->assertSame('10000.00', (string)$user->wage->getAmount());
        $this->assertSame('USD', $user->wage->getCurrency()->getCurrencyCode());

        $user->save();

        $this->assertSame(1, $user->id);

        $this->assertDatabaseHas('users', [
            'id' => 1,
            'money' => 100.99,
            'wage' => 10000.00,
            'debits' => 1234.56,
            'currency' => 'AUD',
        ]);
    }
}

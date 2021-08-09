<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Vanthao03596\LaravelWalletEventSourcing\Tests\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'email' => $this->faker->email
        ];
    }
}

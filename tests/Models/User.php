<?php

namespace Vanthao03596\LaravelWalletEventSourcing\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vanthao03596\LaravelWalletEventSourcing\Support\Holder;

class User extends Model implements Holder
{
    use HasFactory;

    protected $table = 'users';

}

<?php

namespace App\Users\Application\Query\FindUser;

use App\Shared\Application\Query\QueryInterface;

class FindUserByEmailQuery implements QueryInterface
{
    public function __construct(public readonly string $email)
    {
    }
}
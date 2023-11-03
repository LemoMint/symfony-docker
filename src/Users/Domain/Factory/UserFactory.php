<?php

namespace App\Users\Domain\Factory;

use App\Users\Domain\Entity\User;
use App\Users\Domain\Service\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    public function create(string $email, string $password): User
    {
        $user = new User($email);
        $user->setPassword($password, $this->hasher);

        return $user;
    }
}
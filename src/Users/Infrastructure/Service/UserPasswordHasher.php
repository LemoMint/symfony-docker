<?php

namespace App\Users\Infrastructure\Service;

use App\Users\Domain\Entity\User;
use App\Users\Domain\Service\UserPasswordHasherInterface;
use \Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface as BaseHasherInterface;
class UserPasswordHasher implements UserPasswordHasherInterface
{
    public function __construct(private readonly BaseHasherInterface $hasher)
    {
    }

    public function hash(User $user, ?string $password): string
    {
        return $this->hasher->hashPassword($user, $password);
    }
}
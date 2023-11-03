<?php

namespace App\Users\Application\Query\FindUser;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Users\Domain\Entity\User;
use App\Users\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

class FindUserByEmailQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

//    public function __invoke(FindUserByEmailQuery $query): ?User
//    {
//        $user = $this->userRepository->findByEmail($query->email);
//
//        if (!$user) {
//            throw new UserNotFoundException();
//
//        }
//
//        return $user;
//    }

    public function __invoke(FindUserByEmailQuery $query)
    {
        $user = $this->userRepository->findByEmail($query->email);

        if (!$user) {
            throw new UserNotFoundException();

        }

        return $user;
    }
}
<?php

namespace App\Tests\Functional\Users\Application\Query\FindUser;

use App\Shared\Application\Query\QueryBusInterface;
use App\Tests\Helpers\DatabaseFixturesHelper;
use App\Tests\Helpers\DIHeper;
use App\Users\Application\Query\FindUser\FindUserByEmailQuery;
use App\Users\Domain\Repository\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FindUserByEmailQueryTest extends WebTestCase
{
    use DIHeper;
    use DatabaseFixturesHelper;

    private readonly QueryBusInterface $bus;

    protected function setUp(): void
    {
        parent::setUp();
        $this->bus = $this->getService(QueryBusInterface::class);
    }

    public function test_user_found_successfully_by_email()
    {
        $user = $this->getUserFixtures();

        $query = new FindUserByEmailQuery($user->getEmail());
        $foundUser = $this->bus->execute($query);

        $this->assertEquals($user->getUlid(), $foundUser->getUlid());
    }
}
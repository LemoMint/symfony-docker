<?php

namespace App\Tests\Functional\Users\Infrastructure\Repositpry;

use App\Tests\Helpers\DatabaseFixturesHelper;
use App\Tests\Helpers\DIHeper;
use App\Tests\Helpers\FakerHelper;
use App\Users\Domain\Factory\UserFactory;
use App\Users\Domain\Repository\UserRepositoryInterface;
use Faker\Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserRepositoryTest extends WebTestCase
{
    use FakerHelper;
    use DIHeper;
    use DatabaseFixturesHelper;

    private Generator $faker;
    private UserRepositoryInterface $userRepository;
    private UserFactory $userFactory;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker = $this->getFaker();
        $this->userRepository = $this->getService(UserRepositoryInterface::class);
        $this->userFactory = $this->getService(UserFactory::class);
    }

    public function test_user_created_successfully(): void
    {
        $user = $this->userFactory->create(
            $this->faker->email(),
            $this->faker->password()
        );

        $this->userRepository->add($user);

        $existingUser = $this->userRepository->findByUlid($user->getUlid());

        $this->assertEquals($existingUser->getUlid(), $user->getUlid());
    }

    public function test_user_found_by_email_successfully(): void
    {
        $user = $this->getUserFixtures();

        $existingUser = $this->userRepository->findByEmail($user->getEmail());

        $this->assertEquals($existingUser->getUlid(), $user->getUlid());
    }
}

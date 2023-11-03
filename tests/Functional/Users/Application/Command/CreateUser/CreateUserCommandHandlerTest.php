<?php

namespace App\Tests\Functional\Users\Application\Command\CreateUser;

use App\Shared\Application\Command\CommandBusInterface;
use App\Tests\Helpers\DIHeper;
use App\Tests\Helpers\FakerHelper;
use App\Users\Application\Command\CreateUser\CreateUserCommand;
use App\Users\Domain\Repository\UserRepositoryInterface;
use Faker\Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateUserCommandHandlerTest extends WebTestCase
{
    use FakerHelper;
    use DIHeper;

    private readonly Generator $faker;
    private readonly UserRepositoryInterface $userRepository;
    private CommandBusInterface $commandBus;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = $this->getService(UserRepositoryInterface::class);
        $this->faker = $this->getFaker();
        $this->commandBus = $this->getService(CommandBusInterface::class);
    }

    public function test_user_created_successfully()
    {
        //Arrange
        $createUserCommand = new CreateUserCommand(
            $this->faker->email(),
            $this->faker->password()
        );
        //Act
        $createUserUlid = $this->commandBus->execute($createUserCommand);
        //Assert
        $realUser = $this->userRepository->findByUlid($createUserUlid);
        $this->assertEquals($createUserUlid, $realUser->getUlid());
    }
}
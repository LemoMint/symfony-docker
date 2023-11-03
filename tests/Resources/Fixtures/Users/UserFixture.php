<?php

namespace App\Tests\Resources\Fixtures\Users;

use App\Tests\Helpers\FakerHelper;
use App\Users\Domain\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    use FakerHelper;

    public const REF = 'user';

    public function __construct(private readonly UserFactory $factory)
    {
    }

    public function load(ObjectManager $manager)
    {
        $email = $this->getFaker()->email();
        $password = $this->getFaker()->password();

        $user = $this->factory->create($email, $password);

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::REF, $user);
    }
}
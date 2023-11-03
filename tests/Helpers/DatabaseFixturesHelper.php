<?php

namespace App\Tests\Helpers;

use App\Tests\Resources\Fixtures\Users\UserFixture;
use App\Users\Domain\Entity\User;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;

trait DatabaseFixturesHelper
{
    use DIHeper;
    public function getDatabaseTools(): AbstractDatabaseTool
    {
        return $this->getService(DatabaseToolCollection::class)->get();
    }

    public function getUserFixtures(): User
    {
        $executor = $this->getDatabaseTools()->loadFixtures([
            UserFixture::class,
        ]);

        return $executor->getReferenceRepository()->getReference(UserFixture::REF);
    }
}
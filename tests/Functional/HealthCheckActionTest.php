<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HealthCheckActionTest extends WebTestCase
{
    public function test_health_check_action_is_successful(): void
    {
        //Arrange
        $client = static::createClient();
        //Act
        $client->request('GET', '/health-check');
        //Assert
        $this->assertResponseIsSuccessful();
        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertEquals('ok', $data["status"]);
    }
}

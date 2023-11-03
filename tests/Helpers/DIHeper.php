<?php

namespace App\Tests\Helpers;

trait DIHeper
{
    public function getService(string $service): mixed
    {
        return static::getContainer()->get($service);
    }
}
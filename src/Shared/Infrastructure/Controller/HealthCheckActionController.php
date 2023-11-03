<?php

namespace App\Shared\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("health-check", name: "health_check_action", methods: ['GET'])]
class HealthCheckActionController
{
    public function __invoke(): Response
    {
        return new JsonResponse(["status" => "ok"]);
    }
}
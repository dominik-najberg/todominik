<?php declare(strict_types=1);

namespace App\UI\Http;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateTaskListController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([], Response::HTTP_BAD_REQUEST);
    }
}

<?php declare(strict_types=1);

namespace App\UI\Http\Response;

use App\UI\Http\Request\CreateTaskListRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateTaskListResponse extends JsonResponse
{
    public static function fromRequest(CreateTaskListRequest $request): self
    {
        return new self(
            [
                "data" => [
                    "type" => "tasklists",
                    "id" => $request->id()->toString(),
                    "attributes" => [
                        "user_id" => $request->userId(),
                        "name" => $request->name(),
                    ],
                ],
            ],
            Response::HTTP_CREATED,
        );
    }
}

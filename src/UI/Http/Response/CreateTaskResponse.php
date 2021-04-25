<?php declare(strict_types=1);

namespace App\UI\Http\Response;

use App\UI\Http\Request\CreateTaskRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateTaskResponse extends JsonResponse
{
    public static function fromRequest(CreateTaskRequest $request): self
    {
        return new self(
            [
                "data" => [
                    "type" => "tasks",
                    "id" => $request->id()->toString(),
                    "attributes" => [
                        "content" => $request->content(),
                        "due_date" => $request->dueDate()->format('Y-m-d H:i:s.u'),
                        "user_id" => $request->userId()->toString(),
                        "tasklist_id" => $request->taskListId()->toString(),
                    ],
                ],
            ],
            Response::HTTP_CREATED,
        );
    }
}

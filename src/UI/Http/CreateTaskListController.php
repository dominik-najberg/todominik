<?php declare(strict_types=1);

namespace App\UI\Http;

use App\UI\Http\Request\CreateTaskListRequest;
use App\UI\Http\Response\CreateTaskListResponse;

class CreateTaskListController
{
    public function __invoke(CreateTaskListRequest $request): CreateTaskListResponse
    {
        return CreateTaskListResponse::fromRequest($request);
    }
}

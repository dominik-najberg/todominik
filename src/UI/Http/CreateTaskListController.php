<?php declare(strict_types=1);

namespace App\UI\Http;

use App\Application\Command\CreateTaskList;
use App\UI\Http\Request\CreateTaskListRequest;
use App\UI\Http\Response\CreateTaskListResponse;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateTaskListController
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(CreateTaskListRequest $request): CreateTaskListResponse
    {
        $this->commandBus->dispatch(
            new CreateTaskList(
                $request->id(),
                $request->userId(),
                $request->name(),
                new \DateTimeImmutable(),
            )
        );

        return CreateTaskListResponse::fromRequest($request);
    }
}

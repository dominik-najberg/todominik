<?php declare(strict_types=1);

namespace App\UI\Http;

use App\Application\Command\CreateTask;
use App\UI\Http\Request\CreateTaskRequest;
use App\UI\Http\Response\CreateTaskResponse;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateTaskController
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(CreateTaskRequest $request): CreateTaskResponse
    {
        $command = new CreateTask(
            $request->id(),
            $request->taskListId(),
            $request->userId(),
            $request->dueDate(),
            $request->content(),
        );

        $this->commandBus->dispatch($command);

        return CreateTaskResponse::fromRequest($request);
    }
}

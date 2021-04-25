<?php declare(strict_types=1);

namespace App\Application\Command;

use App\Application\Repository\TaskListRepository;
use App\Domain\Event\TaskListCreated;
use App\Domain\Task\TaskList;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateTaskListHandler implements MessageHandlerInterface
{
    private MessageBusInterface $eventBus;
    private TaskListRepository $repository;

    public function __construct(MessageBusInterface $eventBus, TaskListRepository $repository)
    {
        $this->eventBus   = $eventBus;
        $this->repository = $repository;
    }

    public function __invoke(CreateTaskList $command): void
    {
        $taskList = TaskList::create($command->id(), $command->userId(), $command->name());

        $this->eventBus->dispatch(
            new TaskListCreated(
                $taskList->id()->toString(),
                $taskList->userId()->toString(),
                $taskList->name(),
                $command->createdAt()->format('Y-m-d H:i:s.u'),
            )
        );

        $this->repository->add($taskList);
    }
}

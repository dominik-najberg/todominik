<?php declare(strict_types=1);

namespace App\Application\Command;

use App\Application\Repository\TaskRepository;
use App\Domain\Event\TaskCreated;
use App\Domain\Task\Task;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateTaskHandler implements MessageHandlerInterface
{
    private TaskRepository $taskRepository;
    private MessageBusInterface $eventBus;

    public function __construct(TaskRepository $taskRepository, MessageBusInterface $eventBus)
    {
        $this->taskRepository = $taskRepository;
        $this->eventBus = $eventBus;
    }

    public function __invoke(CreateTask $command)
    {
        $task = Task::create(
            $command->id(),
            $command->taskListId(),
            $command->userId(),
            $command->dueDate(),
            $command->content(),
        );

        $this->taskRepository->add($task);

        $this->eventBus->dispatch(
            new TaskCreated(
                $task->id()->toString(),
                $task->taskListId()->toString(),
                $task->userId()->toString(),
                $task->dueDate()->format('Y-m-d H:i:s.u'),
                $task->content(),
                $command->dueDate()->format('Y-m-d H:i:s.u'),
            )
        );
    }
}
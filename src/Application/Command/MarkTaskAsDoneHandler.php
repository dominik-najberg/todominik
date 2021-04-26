<?php declare(strict_types=1);

namespace App\Application\Command;

use App\Application\Repository\TaskRepository;
use Symfony\Component\Messenger\MessageBusInterface;

class MarkTaskAsDoneHandler
{
    private TaskRepository $taskRepository;
    private MessageBusInterface $eventBus;

    public function __construct(TaskRepository $taskRepository, MessageBusInterface $eventBus)
    {
        $this->taskRepository = $taskRepository;
        $this->eventBus = $eventBus;
    }

    public function __invoke(MarkTaskAsDone $command)
    {
        $task = $this->taskRepository->getById($command->taskId());
        $this->eventBus->dispatch($task->markAsDone($command->userId()));
    }
}
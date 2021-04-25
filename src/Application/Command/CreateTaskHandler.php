<?php declare(strict_types=1);

namespace App\Application\Command;

use App\Application\Repository\TaskRepository;
use App\Domain\Task\Task;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateTaskHandler implements MessageHandlerInterface
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
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
    }
}
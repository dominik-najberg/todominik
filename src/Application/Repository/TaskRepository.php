<?php

namespace App\Application\Repository;

use App\Application\Exception\TaskNotFoundException;
use App\Domain\Task\Task;
use Ramsey\Uuid\UuidInterface;

interface TaskRepository
{
    public function add(Task $taskList): void;

    /**
     * @throws TaskNotFoundException
     */
    public function getById(UuidInterface $taskId): Task;
}

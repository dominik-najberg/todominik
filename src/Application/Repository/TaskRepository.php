<?php

namespace App\Application\Repository;

use App\Domain\Task\Task;

interface TaskRepository
{
    public function add(Task $taskList): void;
}

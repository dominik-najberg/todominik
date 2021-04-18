<?php

namespace App\Application\Repository;

use App\Domain\Task\TaskList;

interface TaskListRepository
{
    public function add(TaskList $taskList): void;
}

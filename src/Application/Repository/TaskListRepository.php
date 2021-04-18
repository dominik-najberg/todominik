<?php

namespace App\Application\Repository;

use App\Domain\TaskList;

interface TaskListRepository
{
    public function add(TaskList $taskList): void;
}

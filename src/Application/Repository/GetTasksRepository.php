<?php

namespace App\Application\Repository;

use App\Application\Exception\TaskNotFoundException;
use App\Application\Query\ViewModel\TaskDto;
use Ramsey\Uuid\UuidInterface;

interface GetTasksRepository
{
    /**
     * @return TaskDto[]
     * @throws TaskNotFoundException
     */
    public function getByListId(UuidInterface $listId): array;
}
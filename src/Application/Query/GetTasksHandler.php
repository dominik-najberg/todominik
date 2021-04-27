<?php declare(strict_types=1);

namespace App\Application\Query;

use App\Application\Exception\TaskNotFoundException;
use App\Application\Query\ViewModel\TaskDto;
use App\Application\Repository\GetTasksRepository;

class GetTasksHandler
{
    private GetTasksRepository $getTasksRepository;

    public function __construct(GetTasksRepository $getTasksRepository)
    {
        $this->getTasksRepository = $getTasksRepository;
    }

    /**
     * @return TaskDto[]
     * @throws TaskNotFoundException
     */
    public function __invoke(GetTasks $query): array
    {
        return $this->getTasksRepository->getByListId($query->listId());
    }
}